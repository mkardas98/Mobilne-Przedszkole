<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    protected $table = 'behaviors';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kid_id',
        'type',
        'text',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
