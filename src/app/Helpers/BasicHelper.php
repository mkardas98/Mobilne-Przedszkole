<?php

use App\Models\BasicFields;

function getBasicField($name){
    $basicField = BasicFields::where('name', '=', $name)->first();

    if($basicField){
        return $basicField->value;
    }
    return '';
}


