{{-- livewire/factura-manager.blade.php --}}
<div>
    {{-- Contenedor de AdminLTE para un diseño limpio --}}
    <div class="card">
        <div class="card-header">
            Gestión de Facturas
        </div>
        <div class="card">
            <div class="card-header">
                Crear Nueva Factura
            </div>
            <div class="card-body">
                <form wire:submit.prevent="saveFactura">
                    {{-- Campo para seleccionar un cliente --}}
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <select id="cliente" class="form-control" wire:model="clienteSeleccionado" required>
                            <option value="">Selecciona un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->codigo }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Campo para seleccionar productos --}}
                    <div class="form-group">
                        <label for="productos">Productos</label>
                        <select id="productos" class="form-control" wire:model="productosSeleccionados" multiple required>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->producto }} ({{ $producto->cantidad }} en stock)</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Factura</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Lista de Facturas
            </div>
            <div class="card-body">
                {{-- Aquí irá la tabla para mostrar las facturas --}}
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            Lista de Facturas
        </div>
        <div class="card-body">
            {{-- Aquí irá la tabla para mostrar las facturas --}}
        </div>
    </div>
</div>