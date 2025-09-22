<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

     public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'facturas', 'id_producto', 'codigo_cliente');
    }
}
