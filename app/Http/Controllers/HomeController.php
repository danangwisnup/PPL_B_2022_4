<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // route to login
        if (auth()->guest()) {
            return redirect()->route('login');
        }
        // if user has logged in, route to dashboard
        return redirect()->route('dashboard');
    }
}
