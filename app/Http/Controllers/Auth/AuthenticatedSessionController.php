<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = auth()->user();

/*
|--------------------------------------------------------------------------
| ADMINISTRADOR
|--------------------------------------------------------------------------
*/

if (

    $user->tieneRol('Administrador')

    ||

    $user->tieneRol('Coordinador')
) {

    return redirect()->route('dashboard');
}

/*
|--------------------------------------------------------------------------
| INSTRUCTOR
|--------------------------------------------------------------------------
*/

if (

    $user->tieneRol('Instructor')
) {

    return redirect()->route('seguimientos.index');
}

/*
|--------------------------------------------------------------------------
| APRENDIZ
|--------------------------------------------------------------------------
*/

if (

    $user->tieneRol('Aprendiz')
) {

    return redirect()->route('bitacoras.index');
}

/*
|--------------------------------------------------------------------------
| DEFAULT
|--------------------------------------------------------------------------
*/

return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
