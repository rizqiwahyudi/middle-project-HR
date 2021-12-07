<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function checkRole()
    {
        $user = Auth::user();

        if ($user->role->is('admin')) {
            return route('dashboard.admin');
        } else {
            return route('dashboard.user');
        }
    }
}
