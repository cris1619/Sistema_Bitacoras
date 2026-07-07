<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProgramaFormacionController;
use App\Http\Controllers\FichaController;
use App\Http\Controllers\AprendizController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\BitacoraEvidenciaController;

/*
|--------------------------------------------------------------------------
| WELCOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    return view('welcome');

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';

/*
|--------------------------------------------------------------------------
| DASHBOARD GENERAL
|--------------------------------------------------------------------------
*/

Route::middleware([

    'auth',
    'rol:Administrador,Coordinador'

])->group(function () {

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

    })->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| PROGRAMAS
|--------------------------------------------------------------------------
*/

Route::middleware([

    'auth',
    'rol:Administrador,Coordinador'

])->group(function () {

    Route::resource(
        'programas',
        ProgramaFormacionController::class
    );
});

/*
|--------------------------------------------------------------------------
| FICHAS
|--------------------------------------------------------------------------
*/

Route::middleware([

    'auth',
    'rol:Administrador,Coordinador'

])->group(function () {

    Route::resource(
        'fichas',
        FichaController::class
    );
});

/*
|--------------------------------------------------------------------------
| APRENDICES
|--------------------------------------------------------------------------
*/

Route::middleware([

    'auth',
    'rol:Administrador,Coordinador,Instructor'

])->group(function () {

    Route::resource(
        'aprendices',
        AprendizController::class
    );

    Route::get(

        'aprendices/{aprendice}/dashboard',

        [AprendizController::class, 'dashboard']

    )->name('aprendices.dashboard');
});

/*
|--------------------------------------------------------------------------
| SEGUIMIENTOS
|--------------------------------------------------------------------------
*/

Route::middleware([

    'auth',
    'rol:Administrador,Coordinador,Instructor'

])->group(function () {

    Route::resource(
        'seguimientos',
        SeguimientoController::class
    );
});

/*
|--------------------------------------------------------------------------
| BITÁCORAS
|--------------------------------------------------------------------------
*/

Route::middleware([

    'auth',
    'rol:Administrador,Coordinador,Instructor,Aprendiz'

])->group(function () {

    Route::resource(
        'bitacoras',
        BitacoraEvidenciaController::class
    );
});