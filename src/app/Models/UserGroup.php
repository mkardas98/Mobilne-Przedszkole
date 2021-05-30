<?php

namespace App\Models;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserGroup extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user_groups';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'group_id',
    ];

}
