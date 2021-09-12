<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Kid;
use App\Models\User;
use App\Models\ViewHistory;
use Carbon\Carbon;
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
       $viewsHistory = ViewHistory::all()->sortBy('date')->take(-14);
        $data = [];
        $data['groups'] = count(Group::where('status', 1)->get());
        $data['teachers'] = count(User::where('role', 1)->get());
        $data['kids'] = count(Kid::all());
        return view('director.home', [
            'views' => $viewsHistory,
            'data' => $data,
        ]);
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
