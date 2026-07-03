<?php

namespace App\Http\Controllers;

use App\Models\Aprendiz;
use App\Models\Ficha;
use App\Models\EstadoAprendiz;
use App\Models\VinculoFormativo;
use Illuminate\Http\Request;
use App\Models\BitacoraEvidencia;
use App\Models\EstadoBitacora;
use Carbon\Carbon;
use App\Models\Seguimiento;
use App\Models\EstadoSeguimiento;
use App\Models\User;

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

    $aprendiz = Aprendiz::create($request->all());

$estadoPendiente = EstadoBitacora::where(

    'nombre_estado',
    'Pendiente'

)->first();

$inicio = Carbon::parse(
    $aprendiz->fecha_inicio_practica
);

$finPractica = Carbon::parse(
    $aprendiz->fecha_fin_practica
);

for ($i = 1; $i <= 12; $i++) {

    // INICIO BITÁCORA

    $inicioBitacora = $inicio->copy();

    // FIN BITÁCORA

    if ($inicioBitacora->day <= 15) {

        $finBitacora =
            $inicioBitacora
                ->copy()
                ->day(15);

    } else {

        $finBitacora =
            $inicioBitacora
                ->copy()
                ->endOfMonth();
    }

    // AJUSTAR ÚLTIMA

    if ($finBitacora->gt($finPractica)) {

        $finBitacora =
            $finPractica->copy();
    }

    BitacoraEvidencia::create([

        'aprendiz_id' => $aprendiz->id,

        'seguimiento_id' => null,

        'estado_id' => $estadoPendiente->id,

        'numero_bitacora' => $i,

        'fecha_limite_entrega' =>
            $finBitacora,

        'fecha_entrega' => null,

        'archivo_evidencia_url' => null,

        'novedades' =>

            'Periodo: ' .

            $inicioBitacora->format('d/m/Y')

            . ' al ' .

            $finBitacora->format('d/m/Y'),
    ]);

    // SIGUIENTE QUINCENA

    $inicio = $finBitacora
        ->copy()
        ->addDay();
}

$estadoSeguimiento = EstadoSeguimiento::where(

    'nombre_estado',
    'Pendiente'

)->first();

/*
|--------------------------------------------------------------------------
| FECHAS PROGRAMADAS
|--------------------------------------------------------------------------
*/

$bitacora6 = BitacoraEvidencia::where(

    'aprendiz_id',
    $aprendiz->id

)->where(
    'numero_bitacora',
    6
)->first();

$bitacora11 = BitacoraEvidencia::where(

    'aprendiz_id',
    $aprendiz->id

)->where(
    'numero_bitacora',
    11
)->first();

$bitacora12 = BitacoraEvidencia::where(

    'aprendiz_id',
    $aprendiz->id

)->where(
    'numero_bitacora',
    12
)->first();

/*
|--------------------------------------------------------------------------
| SEGUIMIENTO 1
|--------------------------------------------------------------------------
*/

Seguimiento::create([

    'aprendiz_id' => $aprendiz->id,

    'instructor_id' => 1,

    'estado_id' => $estadoSeguimiento->id,

    'numero_seguimiento' => 1,

    'fecha_programada' =>
        $bitacora6->fecha_limite_entrega,

    'fecha_realizada' => null,

    'observaciones' => null,

    'compromisos' => null,

    'recomendaciones' => null,

    'archivo_adjunto' => null,
]);

/*
|--------------------------------------------------------------------------
| SEGUIMIENTO 2
|--------------------------------------------------------------------------
*/

Seguimiento::create([

    'aprendiz_id' => $aprendiz->id,

    'instructor_id' => 1,

    'estado_id' => $estadoSeguimiento->id,

    'numero_seguimiento' => 2,

    'fecha_programada' =>
        $bitacora11->fecha_limite_entrega,

    'fecha_realizada' => null,

    'observaciones' => null,

    'compromisos' => null,

    'recomendaciones' => null,

    'archivo_adjunto' => null,
]);

/*
|--------------------------------------------------------------------------
| SEGUIMIENTO FINAL
|--------------------------------------------------------------------------
*/

Seguimiento::create([

    'aprendiz_id' => $aprendiz->id,

    'instructor_id' => 1,

    'estado_id' => $estadoSeguimiento->id,

    'numero_seguimiento' => 3,

    'fecha_programada' =>
        $bitacora12->fecha_limite_entrega,

    'fecha_realizada' => null,

    'observaciones' => null,

    'compromisos' => null,

    'recomendaciones' => null,

    'archivo_adjunto' => null,
]);

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

public function dashboard(Aprendiz $aprendice)
{
    $bitacoras = BitacoraEvidencia::where(

        'aprendiz_id',
        $aprendice->id

    )
    ->orderBy('numero_bitacora')
    ->get();

    $seguimientos = Seguimiento::where(

        'aprendiz_id',
        $aprendice->id

    )
    ->orderBy('numero_seguimiento')
    ->get();

    $totalBitacoras = $bitacoras->count();

$entregadas = $bitacoras->where(

    'estado.nombre_estado',
    'Entregada'

)->count();

$pendientes = $bitacoras->where(

    'estado.nombre_estado',
    'Pendiente'

)->count();

$vencidas = $bitacoras->filter(function ($bitacora) {

    return

        $bitacora->fecha_limite_entrega < now()

        &&

        $bitacora->estado->nombre_estado !=
            'Entregada';

})->count();

$progreso = $totalBitacoras > 0

    ? round(
        ($entregadas / $totalBitacoras) * 100
    )

    : 0;

    return view(

        'aprendices.dashboard',

        compact(
            'aprendice',
            'bitacoras',
            'seguimientos',
            'totalBitacoras',
            'entregadas',
            'pendientes',
            'vencidas',
            'progreso'
        )
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
