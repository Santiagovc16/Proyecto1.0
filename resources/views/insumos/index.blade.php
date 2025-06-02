@extends('layouts.app')

<style>
    body {
        background-color: #12131a;
        color: #e0e0e0;
        font-family: 'Inter', 'Segoe UI', 'Roboto', sans-serif;
    }

    h2.mb-4 {
        font-size: 2rem;
        font-weight: 800;
        color: #000000;
        text-align: center;
        margin-bottom: 2rem !important;
    }

    .btn-primary {
        background-color: #00f2ff;
        border-color: #00f2ff;
        color: #12131a;
        font-weight: 600;
    }

    .btn-primary:hover {
        background-color: #00c2d1;
        border-color: #00c2d1;
        color: #fff;
    }

    .btn-warning {
        background-color: #f9a825;
        border-color: #f9a825;
        color: #12131a;
    }

    .btn-danger {
        background-color: #e53935;
        border-color: #e53935;
        color: #fff;
    }

    .btn-outline-dark {
        border-color: #00f2ff;
        color: #00f2ff;
        font-weight: 600;
    }

    .btn-outline-dark:hover {
        background-color: #00f2ff;
        color: #12131a;
    }

    .table {
        background-color: #1e1e2f;
        color: #e0e0e0;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead {
        background-color: #2c2f48;
        color: #ffffff;
        font-weight: bold;
    }

    .table th, .table td {
        padding: 0.75rem;
        vertical-align: middle;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #222436;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #3a3d5c;
    }
</style>

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Insumos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('insumos.create') }}" class="btn btn-primary mb-3">+ Agregar Insumo</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Modelo del Vehículo</th>
                    <th>Marca</th>
                    <th>Año del Vehículo</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($insumos as $insumo)
                    <tr>
                        <td>{{ $insumo->id }}</td>
                        <td>{{ $insumo->nombre }}</td>
                        <td>{{ $insumo->marca }}</td>
                        <td>{{ $insumo->descripcion }}</td>
                        <td>{{ $insumo->cantidad }}</td>
                        <td>{{ $insumo->estado }}</td>
                        
                        <td>
                            <a href="{{ route('insumos.edit', $insumo) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('insumos.destroy', $insumo) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este insumo?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">No hay insumos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
                ⬅ Volver al Panel Principal
            </a>
        </div>
    </div>
</div>
@endsection