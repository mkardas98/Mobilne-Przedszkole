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
        $now = CarbonImmutable::now();
        $weekStartDate = $now->startOfWeek();
        $weekEndDate = $now->endOfWeek();


        if (!isset($_COOKIE['TodayIsVisitMobilnePrzedszkole'])) {
            setcookie('TodayIsVisitMobilnePrzedszkole', 1, time() + 60 * 60 * 24);
            if (ViewHistory::where('date', Carbon::now()->format('d-m-Y'))->first() === null) {
                $newDay = new ViewHistory;
                $newDay->date = Carbon::now()->format('d-m-Y');
                $newDay->views = 1;
                $newDay->save();
            } else {
                ViewHistory::where('date', Carbon::now()->format('d-m-Y'))
                    ->increment('views');
            }
        }

        return view('default.index');

    }
}
