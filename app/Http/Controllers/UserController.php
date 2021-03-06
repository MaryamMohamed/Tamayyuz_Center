<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:user']);
    }

    public function dashboard()
    {
        # code...
        return view('user.dashboard');
    }
}
