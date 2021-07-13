<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceList extends Model
{
    protected $table = 'attendance_list';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kid_id',
        'date',
        'status',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
