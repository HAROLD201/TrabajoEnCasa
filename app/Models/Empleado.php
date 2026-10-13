<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    protected $fillable = [
        'identificacion',
        'nombre_completo',
        'telefono',
        'email',
        'cargo',
    ];

    public function alquileres(): HasMany
    {
        return $this->hasMany(Alquiler::class);
    }
}

