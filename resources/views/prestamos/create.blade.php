@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Solicitar Préstamo</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige los errores:</strong>
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('prestamos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="insumo_id" class="form-label">Seleccionar Insumo</label>
            <select name="insumo_id" id="insumo_id" class="form-select" required>
                <option value="">-- Selecciona --</option>
                @foreach($insumos as $insumo)
                    @if(strtolower($insumo->estado) !== 'averiado')
                        <option value="{{ $insumo->id }}">{{ $insumo->nombre }} ({{ $insumo->cantidad }} disponibles)</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enviar Solicitud</button>
        <a href="{{ route('prestamos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    
</div>
    <div class="text-center mt-4">
        <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
            ⬅ Volver al Panel Principal
        </a>
    </div>
@endsection