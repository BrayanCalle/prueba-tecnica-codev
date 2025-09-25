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
    public $facturaAEditarId;

    // El método 'mount' se ejecuta una vez cuando el componente se inicia
    public function mount()
    {
        // Se cargan todos los clientes, productos y facturas
        $this->clientes = Cliente::all();
        $this->productos = Producto::all();
        $this->facturas = Factura::all();
    }

    public function saveFactura(){
        $this->validate([
            'clienteSeleccionado' => 'required',
            'productosSeleccionados' => 'required|array|min:1'
        ], [
            'clienteSeleccionado.required' => 'Debes seleccionar un cliente.',
            'productosSeleccionados.required' => 'Debes seleccionar al menos un producto.',
            'productosSeleccionados.min' => 'Debes seleccionar al menos un producto.'
        ]);

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
        
        // Emite un evento para mostrar una notificación de éxito
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => '¡Factura creada con éxito!']);
    }

    public function editFactura($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Factura no encontrada.']);
            return;
        }

        $this->facturaAEditarId = $factura->id;
        $this->clienteSeleccionado = $factura->codigo_cliente;
        $this->productosSeleccionados = [$factura->id_producto]; // Asume que una factura solo tiene un producto para la edición
    }

    public function updateFactura()
    {
        $this->validate([
            'clienteSeleccionado' => 'required',
            'productosSeleccionados' => 'required|array|min:1'
        ], [
            'clienteSeleccionado.required' => 'Debes seleccionar un cliente.',
            'productosSeleccionados.required' => 'Debes seleccionar al menos un producto.',
            'productosSeleccionados.min' => 'Debes seleccionar al menos un producto.'
        ]);

        $factura = Factura::find($this->facturaAEditarId);

        if (!$factura) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Factura no encontrada.']);
            return;
        }

        // Actualiza los campos de la factura
        $factura->update([
            'codigo_cliente' => $this->clienteSeleccionado,
            'id_producto' => $this->productosSeleccionados[0]
        ]);

        // Vuelve a cargar las facturas y limpia el estado de edición
        $this->facturas = Factura::all();
        $this->reset(['facturaAEditarId', 'clienteSeleccionado', 'productosSeleccionados']);
        
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => '¡Factura actualizada con éxito!']);
    }

    public function deleteFactura($id)
    {
        $factura = Factura::find($id);

        if ($factura) {
            $factura->delete();
            $this->facturas = Factura::all(); // Vuelve a cargar la lista
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => '¡Factura eliminada con éxito!']);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'Factura no encontrada.']);
        }
    }

    public function resetearCampos()
    {
        $this->reset(['facturaAEditarId', 'clienteSeleccionado', 'productosSeleccionados']);
    }

    public function render()
    {
        return view('livewire.factura-manager');
    }
}