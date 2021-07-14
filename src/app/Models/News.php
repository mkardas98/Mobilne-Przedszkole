<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = [
        'seo_id',
        'title',
        'lead',
        'text',
        'status',
    ];

    public function seo()
    {
        return $this->belongsTo(Seo::class);
    }
}
