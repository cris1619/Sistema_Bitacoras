<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seguimiento;
use App\Models\Aprendiz;
use App\Models\User;
use App\Models\EstadoSeguimiento;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $user = auth()->user();

    /*
    |--------------------------------------------------------------------------
    | INSTRUCTOR
    |--------------------------------------------------------------------------
    */

    if ($user->tieneRol('Instructor')) {

        $programas = $user
            ->instructor
            ->programaIds();

        $seguimientos = Seguimiento::with([

                'aprendiz',
                'instructor',
                'estado'

            ])
            ->whereHas(

                'aprendiz.ficha',

                function ($query) use ($programas) {

                    $query->whereIn(

                        'programa_id',

                        $programas

                    );

                }

            )
            ->latest()
            ->paginate(10);

    } else {

        /*
        |--------------------------------------------------------------------------
        | ADMINISTRADOR Y COORDINADOR
        |--------------------------------------------------------------------------
        */

        $seguimientos = Seguimiento::with([

                'aprendiz',
                'instructor',
                'estado'

            ])
            ->latest()
            ->paginate(10);

    }

    return view(

        'seguimientos.index',

        compact('seguimientos')

    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $aprendices = Aprendiz::all();

    $instructores = User::all();

    $estados = EstadoSeguimiento::all();

    return view(
        'seguimientos.create',
        compact(
            'aprendices',
            'instructores',
            'estados'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([

        'aprendiz_id' =>
            'required|exists:aprendices,id',

        'instructor_id' =>
            'required|exists:users,id',

        'estado_id' =>
            'required|exists:estados_seguimiento,id',

        'numero_seguimiento' =>
            'required|numeric',

        'fecha_programada' =>
            'required|date',
    ]);

    Seguimiento::create($request->all());

    return redirect()
        ->route('seguimientos.index')
        ->with(
            'success',
            'Seguimiento registrado correctamente'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(Seguimiento $seguimiento)
{
    $seguimiento->load([
        'aprendiz',
        'instructor',
        'estado'
    ]);

    return view(
        'seguimientos.show',
        compact('seguimiento')
    );
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seguimiento $seguimiento)
{
    $aprendices = Aprendiz::all();

    $instructores = User::all();

    $estados = EstadoSeguimiento::all();

    return view(
        'seguimientos.edit',
        compact(
            'seguimiento',
            'aprendices',
            'instructores',
            'estados'
        )
    );
}

    /**
     * Update the specified resource in storage.
     */
    public function update(
    Request $request,
    Seguimiento $seguimiento
)
{
    $request->validate([

        'aprendiz_id' =>
            'required|exists:aprendices,id',

        'instructor_id' =>
            'required|exists:users,id',

        'estado_id' =>
            'required|exists:estados_seguimiento,id',

        'numero_seguimiento' =>
            'required|numeric',

        'fecha_programada' =>
            'required|date',
    ]);

    $seguimiento->update($request->all());

    return redirect()
        ->route('seguimientos.index')
        ->with(
            'success',
            'Seguimiento actualizado correctamente'
        );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seguimiento $seguimiento)
{
    if (
        $seguimiento->fecha_realizada
        ||
        $seguimiento->archivo_adjunto
    ) {

        return redirect()
            ->route('seguimientos.index')
            ->with(
                'error',
                'No se puede eliminar el seguimiento porque ya tiene información registrada.'
            );
    }

    $seguimiento->delete();

    return redirect()
        ->route('seguimientos.index')
        ->with(
            'success',
            'Seguimiento eliminado correctamente.'
        );
}
}
