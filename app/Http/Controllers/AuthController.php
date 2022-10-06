<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        // user logged in, route to dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            // user not logged in, route to login page
            return view('login.index', [
                'title' => 'Login'
            ]);
        }
    }

    // Authenticate user
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (filter_var($credentials['identifier'], FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $credentials['identifier'];
            unset($credentials['identifier']);
        } else {
            $credentials['nim_nip'] = $credentials['identifier'];
            unset($credentials['identifier']);
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'loginError' => 'Login Failed.',
        ])->onlyInput('loginError');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
