<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonPlan extends Model
{
    protected $table = 'lesson_plan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'group_id',
        'plan',
    ];
    protected $casts = [
        'plan' => 'array',
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }




}


