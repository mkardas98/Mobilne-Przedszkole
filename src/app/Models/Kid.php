<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    protected $table = 'kids';
    protected $primaryKey = 'id';
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'pesel',
        'avatar',
        'group_id',
        'user_id',
        'attendance_list',
    ];
    protected $casts = [
        'attendance_list' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function allergens()
    {
        return $this->hasMany(Allergen::class)->orderBy('created_at', 'desc');
    }

    public function behaviors()
    {
        return $this->hasMany(Behavior::class)->orderBy('created_at', 'desc');
    }

    public function attendanceList()
    {
        return $this->hasMany(AttendanceList::class)->orderBy('date', 'desc');
    }
}


