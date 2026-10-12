<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpedienteCliente extends Model
{
    use HasFactory;

    // Campos permitidos para asignación masiva
    protected $fillable = [
        'cliente_id',
        'titulo',
        'archivo_path',
        'tipo'
    ];

    // Relación inversa con el cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}