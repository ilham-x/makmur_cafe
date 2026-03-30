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

    $log = Auth::user(); // ambil user setelah login

    if($log->role === 'cashier'){
        return redirect()->intended(route('cashier.dashboard', absolute: false));
    }
    elseif($log->role === 'admin'){
        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    return redirect()->back();
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}
