<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    // Le indica a Eloquent que la clave primaria de esta tabla es 'codigo'
    protected $primaryKey = 'codigo';

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'facturas', 'codigo_cliente', 'id_producto');
    }
}
