@extends('layouts.app')

<style>
    body {
        background-color: #f3f4f7;
        font-family: 'Inter', 'Segoe UI', sans-serif;
        color: #1a1a1a;
    }

    h2.mb-4 {
        font-size: 2rem;
        font-weight: 800;
        color: #000000;
        text-align: center;
        text-shadow: 0px 1px 4px rgba(0,0,0,0.2);
        margin-bottom: 2rem !important;
    }

    .table {
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        font-size: 0.95rem;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    }

    .table th {
        background-color: #00bfa5;
        color: white;
        font-weight: 600;
        border: none;
    }

    .table td {
        border-top: 1px solid #dee2e6;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2;
    }

    .btn-outline-dark {
        border-color: #00bfa5;
        color: #00bfa5;
        font-weight: 600;
    }

    .btn-outline-dark:hover {
        background-color: #00bfa5;
        color: #ffffff;
    }
</style>

@section('content')
<div class="container">
    <h2 class="mb-4">📍 Reporte de Insumos Disponibles</h2>

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($insumos as $insumo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $insumo->nombre }}</td>
                    <td>{{ $insumo->descripcion }}</td>
                    <td>{{ $insumo->cantidad }}</td>
                    <td>{{ $insumo->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay insumos disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            ⬅ Volver al Panel Principal
        </a>
    </div>
</div>
@endsection