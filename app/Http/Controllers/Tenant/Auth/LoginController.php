<?php

namespace App\Http\Controllers\Tenant\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function loginForm()
    {
        return Inertia::render('Tenant/Auth/Login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Informe um e-mail',
                'email.email' => 'Digite um e-mail válido',
                'password.required' => 'Informe a senha',
            ]
        );

        // dd(\DB::connection()->getDatabaseName());

        if( ! auth()->guard('tenant')->attempt($credentials) )
        {
            return back()->withErrors([
                    'password' => 'Usuário e/ou senha inválido(s)!'
            ]);
        }

        return redirect()->route('tenant.dashboard.index');
    }

    public function logout(Request $request)
    {
        auth()->guard('tenant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('tenant.login');
    }
}
