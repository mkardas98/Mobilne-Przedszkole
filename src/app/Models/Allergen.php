<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allergen extends Model
{
    protected $table = 'allergens';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kid_id',
        'allergen',
    ];

    public function kid()
    {
        return $this->belongsTo(Kid::class);
    }
}
