<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Producto;

class FacturaManager extends Component
{

    // Aquí se declararán las propiedades del componente
    public $clientes;
    public $productos;
    public $clienteSeleccionado;
    public $productosSeleccionados = [];

    // El método 'mount' se ejecuta una vez cuando el componente se inicia
    public function mount()
    {
        $this->clientes = Cliente::all();
        $this->productos = Producto::all();
    }

    public function saveFactura()
    {
        // Encuentra el cliente seleccionado
        $cliente = Cliente::find($this->clienteSeleccionado);

        // Asocia los productos a la factura
        // El método 'sync' de la relación many-to-many
        // se encarga de insertar los registros en la tabla pivote.
        $cliente->productos()->sync($this->productosSeleccionados);

        // Limpia los campos del formulario después de guardar
        $this->clienteSeleccionado = '';
        $this->productosSeleccionados = [];
    }

    public function render()
    {
        return view('livewire.factura-manager');
    }
}
