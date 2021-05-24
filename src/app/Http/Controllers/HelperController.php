<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{

    public function navDirector($view)
    {
        $view->navSections = config('director_nav');
    }

    public function navTeacher($view)
    {
        $view->navSections = config('teacher_nav');
    }
    public function navParent($view)
    {
        $view->navSections = config('parent_nav');
    }

}
