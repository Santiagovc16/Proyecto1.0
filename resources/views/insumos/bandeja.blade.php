@extends('layouts.app')

<style>
    body {
        background-color: #12131a;
        color: #e0e0e0;
        font-family: 'Inter', 'Segoe UI', 'Roboto', sans-serif;
    }
    .section-header {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg,rgb(9, 5, 5),rgb(14, 13, 13), #a6a6a6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
        margin-bottom: 1.5rem;
        text-shadow: 1px 1px 3px rgba(21, 4, 4, 0.2), -1px -1px 3px rgba(0, 0, 0, 0.3);
    }
    .card-header {
        font-weight: 600;
        font-size: 1.05rem;
        letter-spacing: 0.5px;
        background-color: #1c1e2a !important;
        color: #ffffff !important;
        border-bottom: 1px solid #2c2f48;
        padding: 0.6rem 1.25rem;
    }
    .card {
        border-radius: 12px;
        background-color: #1a1b26;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        border: none;
    }
    .card-body {
        padding: 0.75rem 1.25rem;
        font-size: 0.95rem;
    }
    .card.mb-4 {
        margin-bottom: 1.25rem !important;
    }
    .status-circle {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-right: 8px;
        vertical-align: middle;
    }
    .status-green { background-color: #00e676; }
    .status-yellow { background-color: #ffcd38; }
    .status-red { background-color: #ff5f5f; }

    .form-control {
        background-color: #2a2c39;
        color: #f0f0f0;
        border: 1px solid #3d3f5c;
    }

    .form-label {
        color: #b0b3c5;
        font-weight: 500;
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

    .btn-secondary {
        background-color: #3e445a;
        border-color: #3e445a;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #5b6177;
        border-color: #5b6177;
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

    .filter-form {
        background-color: #1a1c27;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        margin-bottom: 2rem;
    }

    .filter-form .form-label {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .filter-form .form-control {
        font-size: 0.875rem;
        padding: 0.45rem 0.75rem;
        border-radius: 6px;
    }

    .filter-form .btn {
        font-size: 0.85rem;
        padding: 0.45rem 0.75rem;
    }
</style>

@section('content')
<div class="container">
    {{-- FORMULARIO DE FILTRO --}}
    <form method="GET" action="{{ route('insumos.bandeja') }}" class="row g-3 mb-4 align-items-end filter-form">
        <div class="col-md-4">
            <label class="form-label">Nombre del insumo</label>
            <input type="text" name="nombre" class="form-control" value="{{ request('nombre') }}" placeholder="Buscar por nombre">
        </div>
        <div class="col-md-3">
            <label class="form-label">Fecha inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ request('fecha_inicio') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Fecha fin</label>
            <input type="date" name="fecha_fin" class="form-control" value="{{ request('fecha_fin') }}">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('insumos.bandeja') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    @if(request('nombre') || request('fecha_inicio') || request('fecha_fin'))
    <div class="text-center">
        <h2 class="section-header">Bandeja de Insumos</h2>
    </div>
    <div class="row">
        <div class="col-md-4">
            {{-- DISPONIBLES --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white">En Bodega (Disponibles)</div>
                <div class="card-body">
                    @forelse($disponibles as $item)
                        <p><span class="status-circle status-green"></span>{{ $item->nombre }} - {{ $item->descripcion }}</p>
                    @empty
                        <p>No hay insumos disponibles.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            {{-- PRESTADOS --}}
            <div class="card mb-4">
                <div class="card-header bg-warning">Prestados</div>
                <div class="card-body">
                    @forelse($prestados as $item)
                        <p><span class="status-circle status-yellow"></span>{{ $item->nombre }} - {{ $item->descripcion }}</p>
                    @empty
                        <p>No hay insumos prestados.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            {{-- AVERIADOS --}}
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">Averiados</div>
                <div class="card-body">
                    @forelse($averiados as $item)
                        <p><span class="status-circle status-red"></span>{{ $item->nombre }} - {{ $item->descripcion }}</p>
                    @empty
                        <p>No hay insumos averiados.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            ⬅ Volver al Panel Principal
        </a>
    </div>
</div>
@endsection
