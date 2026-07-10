<?php

use Illuminate\Support\Facades\Route;

use App\Models\Aprendiz;
use App\Models\Seguimiento;
use App\Models\BitacoraEvidencia;

use App\Http\Controllers\FichaController;
use App\Http\Controllers\AprendizController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\BitacoraEvidenciaController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ProgramaFormacionController;
use App\Http\Controllers\UsuarioController;

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
| DASHBOARD PRINCIPAL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get(

    '/dashboard',

    function () {

        $user = auth()->user();

        /*
        |--------------------------------------------------------------------------
        | APRENDIZ
        |--------------------------------------------------------------------------
        */

        if (
            $user->tieneRol('Aprendiz')
            &&
            $user->aprendiz
        ) {

            return redirect()->route(

                'aprendices.dashboard',

                $user->aprendiz->id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ADMIN / COORDINADOR / INSTRUCTOR
        |--------------------------------------------------------------------------
        */


        $totalAprendices =
            Aprendiz::count();

        $totalBitacoras =
            BitacoraEvidencia::count();

        $pendientes =
            BitacoraEvidencia::whereHas(

                'estado',

                function ($q) {

                    $q->where(
                        'nombre_estado',
                        'Pendiente'
                    );
                }

            )->count();

        $seguimientos =
            Seguimiento::count();

        return view(

            'dashboard',

            compact(
                'totalAprendices',
                'totalBitacoras',
                'pendientes',
                'seguimientos'
            )
        );

    }

)->name('dashboard');

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
| USUARIOS
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'rol:Administrador'
])->group(function () {

    Route::resource(
        'usuarios',
        UsuarioController::class
    );

});

Route::post(

    'usuarios/{usuario}/reset-password',

    [UsuarioController::class, 'resetPassword']

)->name('usuarios.reset-password');

Route::post(

    'usuarios/{usuario}/desactivar',

    [UsuarioController::class,'desactivar']

)->name('usuarios.desactivar');

Route::post(

    'usuarios/{id}/activar',

    [UsuarioController::class,'activar']

)->name('usuarios.activar');

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

});

/*
|--------------------------------------------------------------------------
| DASHBOARD APRENDIZ
|--------------------------------------------------------------------------
*/

Route::middleware([

    'auth',
    'rol:Administrador,Coordinador,Instructor,Aprendiz'

])->group(function () {

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

Route::resource('instructores', InstructorController::class)
    ->parameters([
        'instructores' => 'instructor',
    ]);