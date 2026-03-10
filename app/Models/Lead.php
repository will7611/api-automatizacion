<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'preferred_schedule',
        'source',
        'property_id',
        'status',
        'assigned_to'
    ];

    // Relación con la Propiedad
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    // Relación con el Asesor (Usuario)
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
