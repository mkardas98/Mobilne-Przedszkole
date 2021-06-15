<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $table = 'mail';
    protected $primaryKey = 'id';
    protected $fillable = [
        "host",
        "port",
        "user_name",
        "password" ,
        "password",
        "encryption",
        "from_address",
        "from_name"
    ];

}
