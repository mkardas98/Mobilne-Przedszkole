<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $table = 'gallery_item';
    protected $primaryKey = 'id';
    protected $fillable = [
        'gallery_id',
        'name',
        'url',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
