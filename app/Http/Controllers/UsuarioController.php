<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\ProgramaFormacion;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    $usuarios = User::with([

    'roles',

    'instructor',

    'aprendiz'

    ])

    ->withTrashed()

    ->latest()

    ->paginate(10);

    return view(

        'usuarios.index',

        compact('usuarios')

    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)

    {
        $usuario->load([

            'roles',

            'instructor.programas',

            'aprendiz.ficha.programa',

            'aprendiz.estado'

        ]);

        return view(

            'usuarios.show',

            compact('usuario')

        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
{
    $usuario->load([

        'roles',

        'instructor.programas',

        'aprendiz.ficha.programa'

    ]);

    $roles = Role::all();

    $programas = ProgramaFormacion::all();

    return view(

        'usuarios.edit',

        compact(

            'usuario',

            'roles',

            'programas'

        )

    );
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
{
    $request->validate([

        'nombre_completo' =>

            'required|max:255',

        'email' =>

            'required|email|unique:users,email,' . $usuario->id,

        'password' =>

            'nullable|min:8|confirmed',

        'rol' =>

            'required|exists:roles,id',

        'programas' =>

            'nullable|array'
    ]);

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR USUARIO
    |--------------------------------------------------------------------------
    */

    $datos = [

        'nombre_completo' =>

            $request->nombre_completo,

        'email' =>

            $request->email,
    ];

    /*
    |--------------------------------------------------------------------------
    | CAMBIAR CONTRASEÑA
    |--------------------------------------------------------------------------
    */

    if ($request->filled('password')) {

        $datos['password'] =

            bcrypt($request->password);

    }

    $usuario->update($datos);

    /*
    |--------------------------------------------------------------------------
    | ROL ACTUAL
    |--------------------------------------------------------------------------
    */

    $rolActual = $usuario->roles()->first();

    $rolNuevo = Role::find(

        $request->rol

    );

    /*
|--------------------------------------------------------------------------
| VALIDAR CAMBIO DE PERFIL
|--------------------------------------------------------------------------
*/

if (

    $rolActual->nombre_rol == 'Aprendiz' &&

    $rolNuevo->nombre_rol != 'Aprendiz'

) {

    return back()

        ->withInput()

        ->with(

            'error',

            'No es posible cambiar un aprendiz a otro perfil. Debe crear un nuevo usuario.'

        );

}

if (

    $rolActual->nombre_rol == 'Instructor' &&

    $rolNuevo->nombre_rol == 'Aprendiz'

) {

    return back()

        ->withInput()

        ->with(

            'error',

            'No es posible convertir un instructor en aprendiz.'

        );

}

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR ROL
    |--------------------------------------------------------------------------
    */

    $usuario->roles()->sync([

        $request->rol

    ]);

    /*
    |--------------------------------------------------------------------------
    | SI ES INSTRUCTOR
    |--------------------------------------------------------------------------
    */

    if ($usuario->instructor) {

        $usuario->instructor
            ->programas()
            ->sync(

                $request->programas ?? []

            );

    }

    return redirect()

        ->route('usuarios.index')

        ->with(

            'success',

            'Usuario actualizado correctamente.'

        );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function resetPassword(User $usuario)
{
    /*
    |--------------------------------------------------------------------------
    | DETERMINAR CONTRASEÑA
    |--------------------------------------------------------------------------
    */

    if ($usuario->aprendiz) {

        $password = $usuario
            ->aprendiz
            ->documento_identidad;

    } elseif ($usuario->instructor) {

        $password = $usuario
            ->instructor
            ->documento_identidad;

    } else {

        return redirect()

            ->back()

            ->with(

                'error',

                'No fue posible restablecer la contraseña porque el usuario no tiene un perfil asociado.'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR CONTRASEÑA
    |--------------------------------------------------------------------------
    */

    $usuario->update([

        'password' => Hash::make($password)

    ]);

    return redirect()

    ->back()

    ->with(

        'success',

        'La contraseña del usuario fue restablecida correctamente. Ahora puede iniciar sesión utilizando su número de documento como contraseña.'

    );
}

public function desactivar(User $usuario)
{
    /*
    |--------------------------------------------------------------------------
    | EVITAR DESACTIVAR EL PROPIO USUARIO
    |--------------------------------------------------------------------------
    */

    if ($usuario->id == auth()->id()) {

        return back()->with(

            'error',

            'No puede desactivar su propia cuenta.'

        );

    }

    $usuario->delete();

    return back()->with(

        'success',

        'Usuario desactivado correctamente.'

    );
}

public function activar($id)
{
    $usuario = User::withTrashed()

        ->findOrFail($id);

    $usuario->restore();

    return back()->with(

        'success',

        'Usuario activado correctamente.'

    );
}
}

