<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicFields extends Model
{
    protected $table = 'basic_fields';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'value',
    ];
}
