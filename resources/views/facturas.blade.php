{{-- resources/views/facturas.blade.php --}}

@extends('adminlte::page')

@section('title', 'Facturas')

@section('content_header')
    <h1>Gestión de Facturas</h1>
@stop

@section('content')
    {{-- Aquí se inserta el componente Livewire --}}
    <livewire:factura-manager />
@stop