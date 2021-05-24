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
//    public function index()
//    {
//        return view('home');
//    }

    public function index(){
    }

    public function directorHome()
    {
        return view('director.home');
    }
    public function teacherHome()
    {
        return view('teacher.home');
    }
    public function parentHome()
    {
        return view('parent.home');
    }
}
