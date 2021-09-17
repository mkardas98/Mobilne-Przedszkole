<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participants';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_chat',
        'id_user',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
