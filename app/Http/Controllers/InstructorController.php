<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor;
use App\Models\User;
use App\Models\Role;
use App\Models\ProgramaFormacion;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructores = Instructor::with('programas')
            ->latest()
            ->paginate(10);

        return view(
            'instructores.index',
            compact('instructores')
        );
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = ProgramaFormacion::all();

        return view(
            'instructores.create',
            compact('programas')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'tipo_documento' =>
                'required|max:10',

            'documento_identidad' =>
                'required|unique:instructores',

            'nombres' =>
                'required|max:100',

            'apellidos' =>
                'required|max:100',

            'correo_electronico' =>
                'required|email|unique:instructores',

            'telefono' =>
                'required|max:20',

            'programas' =>
                'required|array'
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREAR USUARIO
        |--------------------------------------------------------------------------
        */

        $user = User::create([

            'nombre_completo' =>

                $request->nombres.' '.$request->apellidos,

            'email' =>

                $request->correo_electronico,

            'password' =>

                Hash::make(
                    $request->documento_identidad
                )
        ]);

        /*
        |--------------------------------------------------------------------------
        | ASIGNAR ROL
        |--------------------------------------------------------------------------
        */

        $rol = Role::where(

            'nombre_rol',

            'Instructor'

        )->first();

        $user->roles()->attach(
            $rol->id
        );

        /*
        |--------------------------------------------------------------------------
        | CREAR INSTRUCTOR
        |--------------------------------------------------------------------------
        */

        $instructor = Instructor::create([

            'user_id' =>

                $user->id,

            'tipo_documento' =>

                $request->tipo_documento,

            'documento_identidad' =>

                $request->documento_identidad,

            'nombres' =>

                $request->nombres,

            'apellidos' =>

                $request->apellidos,

            'correo_electronico' =>

                $request->correo_electronico,

            'telefono' =>

                $request->telefono,
        ]);

        /*
        |--------------------------------------------------------------------------
        | PROGRAMAS
        |--------------------------------------------------------------------------
        */

        $instructor->programas()->attach(

            $request->programas

        );

        return redirect()

            ->route('instructores.index')

            ->with(

                'success',

                'Instructor registrado correctamente.'
            );
    }

    /**
     * Display the specified resource.
     */
public function show(Instructor $instructor)
{
    $instructor->load('programas');

    return view('instructores.show', [
        'instructor' => $instructor
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        $programas = ProgramaFormacion::all();

        return view(
            'instructores.edit',
            [
                'instructor' => $instructor,
                'programas'  => $programas
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
    Request $request,
    Instructor $instructor
)
{
    $request->validate([

        'tipo_documento' =>
            'required|max:10',

        'documento_identidad' =>
            'required|max:20|unique:instructores,documento_identidad,' . $instructor->id,

        'nombres' =>
            'required|max:100',

        'apellidos' =>
            'required|max:100',

        'correo_electronico' =>
            'required|email|max:100|unique:instructores,correo_electronico,' . $instructor->id,

        'telefono' =>
            'required|max:20',

        'programas' =>
            'required|array'
    ]);

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR USUARIO
    |--------------------------------------------------------------------------
    */

    $instructor->user->update([

        'nombre_completo' =>

            $request->nombres .
            ' ' .
            $request->apellidos,

        'email' =>

            $request->correo_electronico,
    ]);

    /*
    |--------------------------------------------------------------------------
    | ACTUALIZAR INSTRUCTOR
    |--------------------------------------------------------------------------
    */

    $instructor->update([

        'tipo_documento' =>
            $request->tipo_documento,

        'documento_identidad' =>
            $request->documento_identidad,

        'nombres' =>
            $request->nombres,

        'apellidos' =>
            $request->apellidos,

        'correo_electronico' =>
            $request->correo_electronico,

        'telefono' =>
            $request->telefono,
    ]);

    /*
    |--------------------------------------------------------------------------
    | PROGRAMAS
    |--------------------------------------------------------------------------
    */

    $instructor->programas()->sync(

        $request->programas

    );

    return redirect()

        ->route('instructores.index')

        ->with(

            'success',

            'Instructor actualizado correctamente.'

        );
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Instructor $instructore)
{
    /*
    |--------------------------------------------------------------------------
    | VALIDAR SI TIENE SEGUIMIENTOS
    |--------------------------------------------------------------------------
    */

    if (
        $instructore->user &&
        $instructore->user->seguimientos()->count() > 0
    ) {

        return redirect()
            ->route('instructores.index')
            ->with(
                'error',
                'No se puede eliminar el instructor porque tiene seguimientos asociados.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR RELACIÓN CON PROGRAMAS
    |--------------------------------------------------------------------------
    */

    $instructore->programas()->detach();

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR RELACIÓN DE ROLES
    |--------------------------------------------------------------------------
    */

    if ($instructore->user) {

        $instructore->user->roles()->detach();

        /*
        |--------------------------------------------------------------------------
        | ELIMINAR USUARIO
        |--------------------------------------------------------------------------
        */

        $instructore->user->delete();
    }

    /*
    |--------------------------------------------------------------------------
    | ELIMINAR INSTRUCTOR
    |--------------------------------------------------------------------------
    */

    $instructore->delete();

    return redirect()
        ->route('instructores.index')
        ->with(
            'success',
            'Instructor eliminado correctamente.'
        );
}
}
