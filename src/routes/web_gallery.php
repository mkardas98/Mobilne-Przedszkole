<?php

use App\Http\Controllers\PageController;
use App\Models\Gallery;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if((Schema::hasTable('gallery')) && (Schema::hasTable('seo'))){
    $items = Gallery::with(['seo', 'galleryItems'])->where('status', '=', 1)->get();

    if(count($items)>0){
        foreach ($items as $item){
            if($item->seo){
                Route::get($item->seo->seo_url, [PageController::class, 'galleryShow'])->defaults('item', $item)->name('gallery.show.'.$item->id);
            }
        }
    }
}




