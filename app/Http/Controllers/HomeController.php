<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//IRHAMUL ISLAM | irham07093 || irham@gmail.com
use Auth;
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
        return view('backend.master');
    }

    public function logout(){
        Auth::logout();
        return redirect ('my-admin');
    }
}
