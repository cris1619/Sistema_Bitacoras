<?php

namespace App\Http\Controllers;

use App\Models\ProgramaFormacion;
use Illuminate\Http\Request;

class ProgramaFormacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $programas = ProgramaFormacion::latest()->paginate(10);

        return view(
            'programas.index',
            compact('programas')
        );
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('programas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([

        'codigo_programa' => 'required|max:20|unique:programas_formacion',

        'nombre_programa' => 'required|max:150',

        'nivel_formacion' => 'required|max:50'
    ]);

    ProgramaFormacion::create($request->all());

    return redirect()
        ->route('programas.index')
        ->with(
            'success',
            'Programa creado correctamente'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramaFormacion $programa)
    {
        return view(
            'programas.edit',
            compact('programa')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
    Request $request,
    ProgramaFormacion $programa
)
{
    $request->validate([

        'codigo_programa' =>
            'required|max:20|unique:programas_formacion,codigo_programa,' . $programa->id,

        'nombre_programa' =>
            'required|max:150',

        'nivel_formacion' =>
            'required|max:50'
    ]);

    $programa->update($request->all());

    return redirect()
        ->route('programas.index')
        ->with(
            'success',
            'Programa actualizado correctamente'
        );
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramaFormacion $programa)
{
    if (
        $programa->fichas()->count() > 0
    ) {

        return redirect()
            ->route('programas.index')
            ->with(
                'error',
                'No se puede eliminar el programa porque tiene fichas asociadas.'
            );
    }

    $programa->delete();

    return redirect()
        ->route('programas.index')
        ->with(
            'success',
            'Programa eliminado correctamente'
        );
}
}
