<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'email',
        'cargo',
        'fecha_contratacion',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_contratacion' => 'date',
        ];
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }
}
