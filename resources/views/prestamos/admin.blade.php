@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Gestión de Solicitudes de Préstamo</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Funcionario</th>
                    <th>Insumo</th>
                    <th>Estado</th>
                    <th>Rango Fechas</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prestamos as $p)
                    <tr>
                        <td>{{ $p->user->name ?? 'Usuario no disponible' }}</td>
                        <td>{{ $p->insumo->nombre }}</td>
                        <td><strong>{{ ucfirst($p->estado) }}</strong></td>
                        <td>{{ $p->fecha_inicio }} → {{ $p->fecha_fin }}</td>
                        <td>
                            @if($p->estado === 'pendiente')
                                <form action="{{ route('prestamos.estado', $p->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="estado" value="aprobado">
                                    <button class="btn btn-success btn-sm">Aprobar</button>
                                </form>
                                <form action="{{ route('prestamos.estado', $p->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="estado" value="rechazado">
                                    <button class="btn btn-danger btn-sm">Rechazar</button>
                                </form>
                            @else
                                <form action="{{ route('prestamos.estado', $p->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    <input type="hidden" name="estado" value="finalizado">
                                    <button class="btn btn-secondary btn-sm">Finalizar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="text-center mt-4">
    <a href="{{ route('users.index') }}" class="btn btn-outline-dark">
        ⬅ Volver al Panel Principal
    </a>
</div>
@endsection