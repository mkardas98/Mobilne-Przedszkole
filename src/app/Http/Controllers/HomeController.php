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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    public function index()
//    {
//        return view('home');
//    }

    public function index(){
        switch (auth()->user()->role) {
            case 0:
                return redirect(route('director_home.show'));
            case 1:
                return redirect(route('teacher_home.show'));
            case 2:
                return redirect(route('parent_home.show'));
            default:
                return redirect(route('login'));
        }
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
