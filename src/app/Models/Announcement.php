<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'id';
    protected $fillable = [
        'group_id',
        'title',
        'text',
        'status'
    ];

    public function group(){
        return $this->belongsTo(Group::class)->orderBy('created_at');
    }
}
