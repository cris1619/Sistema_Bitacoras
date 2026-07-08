<?php

namespace App\Http\Controllers;

use App\Models\BitacoraEvidencia;
use App\Models\Aprendiz;
use App\Models\Seguimiento;
use App\Models\EstadoBitacora;
use Illuminate\Http\Request;

class BitacoraEvidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $buscar = $request->buscar;

    $user = auth()->user();

    $aprendices = Aprendiz::with([

        'ficha.programa',

        'bitacoras.estado'

    ])

    /*
    |--------------------------------------------------------------------------
    | FILTRO POR INSTRUCTOR
    |--------------------------------------------------------------------------
    */

    ->when(

        $user->tieneRol('Instructor'),

        function ($query) use ($user) {

            $programas = $user->instructor
                ->programas
                ->pluck('id');

            $query->whereHas(

                'ficha',

                function ($q) use ($programas) {

                    $q->whereIn(
                        'programa_id',
                        $programas
                    );

                }

            );

        }

    )

    /*
    |--------------------------------------------------------------------------
    | BUSCADOR
    |--------------------------------------------------------------------------
    */

    ->when(

        $buscar,

        function ($query) use ($buscar) {

            $query->where(function ($q) use ($buscar) {

                $q->where(
                    'nombres',
                    'like',
                    "%{$buscar}%"
                )

                ->orWhere(
                    'apellidos',
                    'like',
                    "%{$buscar}%"
                )

                ->orWhere(
                    'documento_identidad',
                    'like',
                    "%{$buscar}%"
                );

            });

        }

    )

    ->latest()

    ->paginate(10);

    return view(

        'bitacoras.index',

        compact(

            'aprendices',

            'buscar'

        )

    );
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $aprendices = Aprendiz::all();

    $seguimientos = Seguimiento::all();

    $estados = EstadoBitacora::all();

    return view(
        'bitacoras.create',
        compact(
            'aprendices',
            'seguimientos',
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

        'estado_id' =>
            'required|exists:estados_bitacora,id',

        'numero_bitacora' =>

        'required|numeric|

        unique:bitacoras_evidencias,numero_bitacora,NULL,id,aprendiz_id,'

        . $request->aprendiz_id,

        'fecha_limite_entrega' =>
            'required|date',

        'archivo_evidencia_url' =>
            'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
    ]);

    $datos = $request->all();

    // SUBIR ARCHIVO

    if ($request->hasFile('archivo_evidencia_url')) {

        $archivo = $request
            ->file('archivo_evidencia_url')
            ->store(
                'evidencias',
                'public'
            );

        $datos['archivo_evidencia_url']
            = $archivo;
    }

    BitacoraEvidencia::create($datos);

    return redirect()
        ->route('bitacoras.index')
        ->with(
            'success',
            'Bitácora registrada correctamente'
        );
}

    /**
     * Display the specified resource.
     */
    public function show(BitacoraEvidencia $bitacora)
{
    $bitacora->load([

        'aprendiz',
        'seguimiento',
        'estado'

    ]);

    return view(
        'bitacoras.show',
        compact('bitacora')
    );
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BitacoraEvidencia $bitacora)
{
    $aprendices = Aprendiz::all();

    $seguimientos = Seguimiento::all();

    $estados = EstadoBitacora::all();

    return view(
        'bitacoras.edit',
        compact(
            'bitacora',
            'aprendices',
            'seguimientos',
            'estados'
        )
    );
}

    /**
     * Update the specified resource in storage.
     */
public function update(
    Request $request,
    BitacoraEvidencia $bitacora
)
{
    $request->validate([

        'aprendiz_id' =>
            'required|exists:aprendices,id',

        'estado_id' =>
            'required|exists:estados_bitacora,id',

        'numero_bitacora' =>

        'required|numeric|

        unique:bitacoras_evidencias,numero_bitacora,'

        . $bitacora->id .

        ',id,aprendiz_id,'

        . $request->aprendiz_id,

        'fecha_limite_entrega' =>
            'required|date',

        'archivo_evidencia_url' =>
            'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
    ]);

    $datos = $request->all();

    // SUBIR NUEVO ARCHIVO

    if ($request->hasFile('archivo_evidencia_url')) {

        $archivo = $request
            ->file('archivo_evidencia_url')
            ->store(
                'evidencias',
                'public'
            );

        $datos['archivo_evidencia_url']
            = $archivo;
    }

    $bitacora->update($datos);

    return redirect()
        ->route('bitacoras.index')
        ->with(
            'success',
            'Bitácora actualizada correctamente'
        );
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BitacoraEvidencia $bitacora)
{
    $bitacora->delete();

    return redirect()
        ->route('bitacoras.index')
        ->with(
            'success',
            'Bitácora eliminada correctamente'
        );
}

}
