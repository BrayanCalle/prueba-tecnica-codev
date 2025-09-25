{{-- livewire/factura-manager.blade.php --}}
<div>
    {{-- Contenedor de AdminLTE para un diseño limpio --}}
    <div class="card">
        <div class="card-header">
            Gestión de Facturas
        </div>
        <div class="card">
            <div class="card-header">
                @if ($facturaAEditarId)
                    Editar Factura
                @else
                    Crear Nueva Factura
                @endif
            </div>
            <div class="card-body">
                <form wire:submit.prevent="@if ($facturaAEditarId) updateFactura @else saveFactura @endif">
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

                    <button type="submit" class="btn btn-primary">
                        @if ($facturaAEditarId)
                            Actualizar Factura
                        @else
                            Guardar Factura
                        @endif
                    </button>
                    @if ($facturaAEditarId)
                        <button wire:click="resetearCampos" type="button" class="btn btn-secondary">Cancelar</button>
                    @endif
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Lista de Facturas
            </div>
            <div class="card-body">
                @if ($facturas->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Producto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facturas as $factura)
                                <tr>
                                    <td>{{ $factura->cliente->nombre }}</td>
                                    <td>{{ $factura->producto->producto }}</td>
                                    <td>
                                        <button wire:click="editFactura({{ $factura->id }})" class="btn btn-sm btn-primary">Editar</button>
                                        <button wire:click="deleteFactura({{ $factura->id }})" class="btn btn-sm btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay facturas registradas.</p>
                @endif
            </div>
        </div>
    </div>
</div>