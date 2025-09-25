<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Factura;

class FacturaManager extends Component
{

    // Aquí se declararán las propiedades del componente
    public $clientes;
    public $productos;
    public $clienteSeleccionado;
    public $productosSeleccionados = [];
    public $facturas;

    // El método 'mount' se ejecuta una vez cuando el componente se inicia
    public function mount()
    {
        // Se cargan todos los clientes, productos y facturas
        $this->clientes = Cliente::all();
        $this->productos = Producto::all();
        $this->facturas = Factura::all();
    }

    public function saveFactura(){
        // Asegúrate de que los campos no estén vacíos antes de procesar
        if (!empty($this->clienteSeleccionado) && !empty($this->productosSeleccionados)) {
            foreach ($this->productosSeleccionados as $id_producto) {
                Factura::create([
                    'codigo_cliente' => $this->clienteSeleccionado,
                    'id_producto' => $id_producto,
                ]);
            }

            // Vuelve a cargar las facturas para que la tabla se actualice en la vista
            $this->facturas = Factura::all();

            // Limpia los campos del formulario después de guardar
            $this->clienteSeleccionado = '';
            $this->productosSeleccionados = [];

        }
    }

    public function render()
    {
        return view('livewire.factura-manager');
    }
}
