<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';
    protected $primaryKey = 'id';
    protected $fillable = [
        'room',
        'name',
        'color',
        'status'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_groups');
    }

    public function kids()
    {
        return $this->hasMany(Kid::class);
    }

    public function announcements(){
        return $this->hasMany(Announcement::class)->orderBy('created_at', 'desc');
    }

    public function lessonPlan(){
        return $this->hasMany(LessonPlan::class)->orderBy('date', 'desc');
    }
}
