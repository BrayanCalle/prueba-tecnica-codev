<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    // Indica los campos que se pueden llenar masivamente
    protected $fillable = ['codigo_cliente', 'id_producto'];

    // Define la relación con el cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'codigo_cliente', 'codigo');
    }

    // Define la relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }

}
