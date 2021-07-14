<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
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

    public function galleryItems()
    {
        return $this->hasMany(GalleryItem::class);
    }
}
