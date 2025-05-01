@extends('layouts.app')

@push('styles')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 13px;
        background-color: #ffffff;
    }
    .report-title {
        background-color: #f1f1f1;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
        text-align: center;
        margin-bottom: 20px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
    }
    .table thead {
        background-color: #007bff;
        color: white;
    }
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .table tr:hover {
        background-color: #f1f1f1;
    }
    .btn {
        display: inline-block;
        padding: 10px 16px;
        font-size: 14px;
        color: white;
        background-color: #343a40;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="report-title">
        <h2 class="mb-0">📁 Reporte de Préstamos</h2>
        <small>Control de calidad de software — {{ now()->format('d/m/Y') }}</small>
    </div>

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Insumo</th>
                <th>Solicitado por</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Estado</th>
                <th>Solicitado el</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prestamos as $prestamo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $prestamo->insumo->nombre ?? 'Insumo no disponible' }}</td>
                    <td>{{ $prestamo->usuario->name ?? 'Usuario no disponible' }}</td>
                    <td>{{ $prestamo->fecha_inicio }}</td>
                    <td>{{ $prestamo->fecha_fin }}</td>
                    <td>{{ ucfirst($prestamo->estado) }}</td>
                    <td>{{ $prestamo->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay préstamos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn">
            ⬅ Volver al Panel Principal
        </a>
    </div>
</div>
@endsection