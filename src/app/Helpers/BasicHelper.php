<?php

use App\Models\BasicFields;
use Artesaos\SEOTools\Facades\SEOMeta;

function getBasicField($name){
    $basicField = BasicFields::where('name', '=', $name)->first();

    if($basicField){
        return $basicField->value;
    }
    return '';
}

function uploadCkeditor(){
    dump(5);
}

