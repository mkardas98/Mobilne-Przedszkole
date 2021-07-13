<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EatMenu extends Model
{
    protected $table = 'eat_menu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'eats',
        'date',
    ];
    protected $casts = [
        'eats' => 'array',
    ];




}


