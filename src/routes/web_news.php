<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Models\News;
use Illuminate\Support\Facades\Schema;

if((Schema::hasTable('news')) && (Schema::hasTable('seo')))
$items = News::with(['seo'])->where('status', '=', 1)->get();

Route::get('profil', [ProfileController::class, 'show'])->name('profile.show');

if(count($items)>0){
        foreach ($items as $item){
            if($item->seo){
                Route::get($item->seo->seo_url, [PageController::class, 'newsShow'])->defaults('item', $item)->name('news.show.'.$item->id);
            }
        }
}
