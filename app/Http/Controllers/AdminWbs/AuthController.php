<?php

namespace App\Http\Controllers\AdminWbs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('adminwbs.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('adminwbs')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('adminwbs.dashboard');
        }

        return back()
            ->with('error', 'Email atau password salah')
            ->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('adminwbs')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('adminwbs.login');
    }
}
