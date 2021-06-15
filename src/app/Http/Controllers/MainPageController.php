<?php

namespace App\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\ViewHistory;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;

class MainPageController extends Controller
{


    public function index()
    {
//        $now = CarbonImmutable::now();
//        $weekStartDate = $now->startOfWeek();
//        $weekEndDate = $now->endOfWeek();

        $currentDay = date('Y-m-d', strtotime( Carbon::now()));
//        dd($currentDay);
        if (!isset($_COOKIE['TodayIsVisitMobilnePrzedszkole'])) {
            setcookie('TodayIsVisitMobilnePrzedszkole', 1, time() + 60 * 60 * 24);
            if (ViewHistory::where('date', $currentDay)->first() === null) {
                $newDay = new ViewHistory;
                $newDay->date = $currentDay;
                $newDay->views = 1;
                $newDay->save();
            } else {
                ViewHistory::where('date', $currentDay)
                    ->increment('views');
            }
        }

        return view('default.index');

    }
}
