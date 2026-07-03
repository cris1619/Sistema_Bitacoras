<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramaFormacionController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\AprendizController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\BitacoraEvidenciaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $totalAprendices =
        \App\Models\Aprendiz::count();

    $totalBitacoras =
        \App\Models\BitacoraEvidencia::count();

    $pendientes =
        \App\Models\BitacoraEvidencia::whereHas(

            'estado',

            function ($q) {

                $q->where(
                    'nombre_estado',
                    'Pendiente'
                );
            }

        )->count();

    $seguimientos =
        \App\Models\Seguimiento::count();

    return view(

        'dashboard',

        compact(
            'totalAprendices',
            'totalBitacoras',
            'pendientes',
            'seguimientos'
        )
    );

})->name('dashboard')->middleware('auth');


require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::resource(
        'programas',
        ProgramaFormacionController::class
    );

});

Route::resource(
    'fichas',
    FichaController::class
);

Route::resource(
    'aprendices',
    AprendizController::class
);

Route::resource(
    'seguimientos',
    SeguimientoController::class
);

Route::resource(
    'bitacoras',
    BitacoraEvidenciaController::class
);

Route::get(

    'aprendices/{aprendice}/dashboard',

    [AprendizController::class, 'dashboard']

)->name('aprendices.dashboard');
