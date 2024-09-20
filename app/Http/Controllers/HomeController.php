<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redirectAdmin()
    {
        return redirect()->route('dashboard');
    }

    public function index()
    {
        return view('home');
    }
}
