@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Mis Solicitudes de Préstamo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('prestamos.create') }}" class="btn btn-primary mb-3">+ Solicitar Préstamo</a>
    <a href="{{ route('reporte.prestamos.pdf') }}" class="btn btn-danger mb-3" target="_blank">
        📄 Descargar PDF de Préstamos
    </a>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Insumo</th>
                    <th>Usuario</th>
                    <th>Estado</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Solicitado el</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestamos as $prestamo)
                    <tr>
                        <td>{{ $prestamo->insumo->nombre }}</td>
                        <td>{{ optional($prestamo->usuario)->name ?? 'Desconocido' }}</td>
                        <td>{{ ucfirst($prestamo->estado) }}</td>
                        <td>{{ $prestamo->fecha_inicio }}</td>
                        <td>{{ $prestamo->fecha_fin }}</td>
                        <td>{{ $prestamo->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6">No has solicitado ningún préstamo aún.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection