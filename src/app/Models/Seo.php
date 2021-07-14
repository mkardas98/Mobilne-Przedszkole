<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'seo_url',
        'seo_title',
        'seo_description',
        'seo_tags',
    ];

    public function news()
    {
        return $this->hasOne(News::class);
    }



}
