<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ficha;
use App\Models\ProgramaFormacion;
use Throwable;

class FichaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $fichas = Ficha::with('programa')
        ->latest()
        ->paginate(10);

    return view(
        'fichas.index',
        compact('fichas')
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $programas = ProgramaFormacion::all();

    return view(
        'fichas.create',
        compact('programas')
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([

        'numero_ficha' =>
            'required|max:20|unique:fichas',

        'programa_id' =>
            'required|exists:programas_formacion,id'
    ]);

    Ficha::create($request->all());

    return redirect()
        ->route('fichas.index')
        ->with(
            'success',
            'Ficha registrada correctamente'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(Ficha $ficha)
{
    return view(
        'fichas.show',
        compact('ficha')
    );
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ficha $ficha)
{
    $programas = ProgramaFormacion::all();

    return view(
        'fichas.edit',
        compact(
            'ficha',
            'programas'
        )
    );
}

    /**
     * Update the specified resource in storage.
     */
    public function update(
    Request $request,
    Ficha $ficha
)
{
    $request->validate([

        'numero_ficha' =>
            'required|max:20|unique:fichas,numero_ficha,' . $ficha->id,

        'programa_id' =>
            'required|exists:programas_formacion,id'
    ]);

    $ficha->update($request->all());

    return redirect()
        ->route('fichas.index')
        ->with(
            'success',
            'Ficha actualizada correctamente'
        );
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Ficha $ficha)
{
    if (
        $ficha->aprendices()->count() > 0
    ) {

        return redirect()
            ->route('fichas.index')
            ->with(
                'error',
                'No se puede eliminar la ficha porque tiene aprendices asociados.'
            );
    }

    $ficha->delete();

    return redirect()
        ->route('fichas.index')
        ->with(
            'success',
            'Ficha eliminada correctamente'
        );
}
}
