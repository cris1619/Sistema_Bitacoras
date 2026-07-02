<?php

namespace App\Http\Controllers;

use App\Models\Aprendiz;
use App\Models\Ficha;
use App\Models\EstadoAprendiz;
use App\Models\VinculoFormativo;
use Illuminate\Http\Request;

class AprendizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $aprendices = Aprendiz::with([
        'ficha.programa',
        'estado',
        'vinculo'
    ])
    ->latest()
    ->paginate(10);

    return view(
        'aprendices.index',
        compact('aprendices')
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $fichas = Ficha::with('programa')->get();

    $estados = EstadoAprendiz::all();

    $vinculos = VinculoFormativo::all();

    return view(
        'aprendices.create',
        compact(
            'fichas',
            'estados',
            'vinculos'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([

        'ficha_id' =>
            'required|exists:fichas,id',

        'estado_id' =>
            'required|exists:estados_aprendiz,id',

        'vinculo_id' =>
            'required|exists:vinculos_formativos,id',

        'tipo_documento' =>
            'required|max:10',

        'documento_identidad' =>
            'required|max:20|unique:aprendices',

        'nombres' =>
            'required|max:100',

        'apellidos' =>
            'required|max:100',

        'correo_electronico' =>
            'required|email|max:100',

        'telefono' =>
            'required|max:20',
    ]);

    Aprendiz::create($request->all());

    return redirect()
        ->route('aprendices.index')
        ->with(
            'success',
            'Aprendiz registrado correctamente'
        );
}

    /**
     * Display the specified resource.
     */
public function show(Aprendiz $aprendice)
{
    $aprendice->load([
        'ficha.programa',
        'estado',
        'vinculo'
    ]);

    return view(
        'aprendices.show',
        compact('aprendice')
    );
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aprendiz $aprendice)
    {
        $fichas = Ficha::with('programa')->get();

        $estados = EstadoAprendiz::all();

        $vinculos = VinculoFormativo::all();

        return view(
            'aprendices.edit',
            compact(
                'aprendice',
                'fichas',
                'estados',
                'vinculos'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
    Request $request,
    Aprendiz $aprendice
)
{
    $request->validate([

        'ficha_id' =>
            'required|exists:fichas,id',

        'estado_id' =>
            'required|exists:estados_aprendiz,id',

        'vinculo_id' =>
            'required|exists:vinculos_formativos,id',

        'tipo_documento' =>
            'required|max:10',

        'documento_identidad' =>
            'required|max:20|unique:aprendices,documento_identidad,' . $aprendice->id,

        'nombres' =>
            'required|max:100',

        'apellidos' =>
            'required|max:100',

        'correo_electronico' =>
            'required|email|max:100',

        'telefono' =>
            'required|max:20',
    ]);

    $aprendice->update($request->all());

    return redirect()
        ->route('aprendices.index')
        ->with(
            'success',
            'Aprendiz actualizado correctamente'
        );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aprendiz $aprendice)
{
    $aprendice->delete();

    return redirect()
        ->route('aprendices.index')
        ->with(
            'success',
            'Aprendiz eliminado correctamente'
        );
}
}
