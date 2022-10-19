<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddUserController extends Controller
{
    public function index()
    {
        return view('operator.add_user.index', [
            'title' => 'Add User',
        ]);
    }
}
