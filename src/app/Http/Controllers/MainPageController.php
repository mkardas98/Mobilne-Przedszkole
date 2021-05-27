<?php

namespace App\Http\Controllers;

use App\Models\ViewHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class MainPageController extends Controller
{
    public function index()
    {

        if(ViewHistory::where('date', Carbon::now()->format('d-m-Y'))->first() === null){
            $newDay = new ViewHistory;
            $newDay->date = Carbon::now()->format('d-m-Y');
            $newDay->views = 1;
            $newDay->save();
        } else {
            ViewHistory::where('date', Carbon::now()->format('d-m-Y'))
                ->increment('views');
        }

        return view('default.index');
    }
}
