<?php

namespace App\Models;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ViewHistory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'view_histories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'date',
        'views',
    ];
}
