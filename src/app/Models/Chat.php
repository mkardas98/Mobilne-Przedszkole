<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    protected $fillable = [

    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
