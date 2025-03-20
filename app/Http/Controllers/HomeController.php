<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role == 'siswa') {
            return redirect()->route('siswa.dashboard');
        } elseif (auth()->user()->role == 'pembimbing') {
            return redirect()->route('pembimbing.dashboard');
        } elseif (auth()->user()->role == 'kepsek') {
            return redirect()->route('kepsek.dashboard');
        } else {
            return redirect()->route('auth.login');
        }
    }
}
