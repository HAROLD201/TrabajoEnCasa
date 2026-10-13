<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    protected $fillable = [
        'identificacion',
        'nombre_completo',
        'telefono',
        'email',
        'direccion',
    ];

    public function alquileres(): HasMany
    {
        return $this->hasMany(Alquiler::class);
    }
}

