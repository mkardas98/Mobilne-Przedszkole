<?php

namespace App\Http\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\ViewHistory;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Cookie;
use Artesaos\SEOTools\Facades\SEOMeta;

class PageController extends Controller
{


    public function index()
    {
        SEOMeta::setTitle('Nazwa');
        SEOMeta::setDescription('test description');
        SEOMeta::addKeyword('tagses');
        $currentDay = date('Y-m-d', strtotime( Carbon::now()));

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

    public function newsShow($item)
    {
        SEOMeta::setTitle($item->seo->seo_title);
        SEOMeta::setDescription($item->dseo_escription);
        SEOMeta::addKeyword($item->seo_tags);
        return view('default.news.show', ['item'=>$item]);
    }
}
