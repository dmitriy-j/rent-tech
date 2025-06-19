<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

public function showLoginForm()
{
    return view('auth.admin-login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Проверяем, что пользователь имеет роль admin
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {

    return redirect()->route('admin.dashboard');
        }

        Auth::logout();
    }

    return back()->withErrors([
        'email' => 'Неверные учетные данные или недостаточно прав.',
    ]);
}
