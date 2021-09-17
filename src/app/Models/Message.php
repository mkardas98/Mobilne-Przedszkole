<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'chat_id',
        'user_id',
        'text',
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }
}
