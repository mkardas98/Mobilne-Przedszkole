<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{

    public function navApp($view)
    {
        $view->user = auth()->user();
        switch (auth()->user()->role) {
            case 0:
                $view->navSections = config('director_nav');
                break;
            case 1:
                $view->navSections = config('teacher_nav');
                break;
            case 2:
                $view->navSections = config('parent_nav');
                break;
        }
    }



}
