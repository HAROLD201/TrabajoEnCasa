<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Alquiler extends Model
{
    protected $table = 'alquileres';
    
    protected $fillable = [
        'cliente_id',
        'empleado_id',
        'fecha_solicitud',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_solicitud' => 'date',
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function empleado(): BelongsTo
    {
        return $this->belongsTo(Empleado::class);
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(AlquilerDetalle::class);
    }
}
