<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['razon_social', 'rfc', 'tipo_persona', 'iguala_mensual', 'activo'];

    // Relación con el expediente digital (HU-05)
    public function expedientes()
    {
        return $this->hasMany(ExpedienteCliente::class);
    }
}
