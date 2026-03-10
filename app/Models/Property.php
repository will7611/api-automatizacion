<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
     protected $guarded = ['id'];
    
    // Casting del JSON de amenidades a Array de PHP
    protected $casts = [
        'amenities' => 'array',
    ];

    public function images()
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
}
