@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(145deg, #e2e8f0, #cbd5e1);
        min-height: 100vh;
        font-family: 'Titillium Web', sans-serif;
        background-attachment: fixed;
    }
    .header-box {
        background: linear-gradient(135deg, #f0f4f8, #dce3ec);
        padding: 3rem 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        max-width: 820px;
        margin: 0 auto 3rem auto;
        text-align: center;
        border: 1px solid rgba(0, 0, 0, 0.08);
    }
    #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background: #101820;
        padding: 20px;
        border-right: 1px solid #2e3a59;
        transform: translateX(-260px);
        transition: transform 0.3s ease;
        z-index: 1000;
        color: white;
        overflow-y: auto;
    }

    #sidebar.active {
        transform: translateX(0);
    }

    #sidebarToggle {
        position: fixed;
        top: 50px;
        left: 20px;
        z-index: 1100;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: none;
        background-color: #343a40;
        color: white;
        font-size: 24px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background 0.3s ease;
    }

    #sidebarToggle:hover {
        background-color: #495057;
    }

    #mainContent {
        margin-left: 0;
        transition: margin-left 0.3s ease;
    }

    #mainContent.active {
        margin-left: 260px;
    }

    .sidebar-section {
        margin-bottom: 1.5rem;
    }

    .sidebar-section h6 {
        margin-top: 1.5rem;
        font-weight: 700;
        color: #a8ff60;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding-bottom: 4px;
        border-left: 4px solid #a8ff60;
        padding-left: 8px;
    }

    .sidebar-section a {
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        color: #00f2ff;
        font-size: 0.95rem;
        padding: 8px 14px;
        border-radius: 6px;
        background-color: #1c2331;
        box-shadow: 0 2px 5px rgba(0,0,0,0.25);
        transition: all 0.3s ease;
        border: 1px solid transparent;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-shadow: 0 0 5px rgba(0, 242, 255, 0.5);
    }

    .sidebar-section a:hover {
        background: linear-gradient(145deg, #00f2ff, #007a99);
        color: #101820;
        box-shadow: 0 4px 10px rgba(0, 242, 255, 0.35);
        border: 1px solid rgba(0, 224, 255, 0.4);
    }

    .sidebar-section a.disabled {
        pointer-events: none;
        color: #6c757d;
    }

    .text-neon {
        color: #00f2ff;
        font-family: 'Orbitron', sans-serif;
        letter-spacing: 0.5px;
    }
</style>

<style>
@keyframes slideInSidebar {
    0% {
        transform: translateX(-280px);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

#sidebar {
    animation: slideInSidebar 0.8s ease-out;
}
</style>

<style>
    .car-image {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .car-image:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 30px rgba(107, 127, 227, 0.25);
    }
</style>

<style>
    .header-box:hover {
        box-shadow: 0 20px 45px rgba(0, 224, 255, 0.3), 0 0 15px rgba(0, 224, 255, 0.2);
        transition: box-shadow 0.4s ease-in-out;
    }
</style>

<button id="sidebarToggle">
    <span>&#9776;</span>
</button>

<div id="sidebar">
    <div style="height: 60px;"></div>
    <div class="sidebar-section">
        <h6>Administración de Insumos</h6>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ route('insumos.bandeja') }}">Bandeja de Insumos</a>
            <a href="{{ route('insumos.index') }}">Ver Todos los Insumos</a>
            <a href="{{ route('dashboard.sorprendeme') }}">Graficas</a>
        @else
            <a class="disabled">Bandeja de Insumos</a>
            <a class="disabled">Ver Insumos</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6>Solicitudes de Préstamo</h6>
        <a href="{{ url('/prestamos/create') }}">Crear Préstamo</a>
        <a href="{{ url('/prestamos') }}">Nuevas Solicitudes</a>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ url('/admin/prestamos') }}">Aprobación</a>
        @else
            <a class="disabled">Aprobación</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6>Administración de Usuarios</h6>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ route('users.create') }}">Crear Usuario</a>
            <a href="#" onclick="toggleUsuarios()">Mostrar/Ocultar Usuarios</a>
        @else
            <a class="disabled">Crear Usuario</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6>Generación de Reportes</h6>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ route('reportes.insumos') }}">Reporte de Insumos</a>
            <a href="{{ route('reportes.prestamos') }}">Reporte de Préstamos</a>
            <a href="{{ route('reportes.disponibles') }}">Insumos Disponibles</a>
        @else
            <a class="disabled">Acceso a Reportes</a>
        @endif
      
</li>
    </div>
</div>

<div id="mainContent">
    <div class="header-box">
        <h1 style="font-size: 3rem; font-weight: 800; color: #1c1c1c; text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);">
             Sistema de Gestión Vehicular
        </h1>
        <p style="font-size: 1.25rem; color:rgb(5, 99, 130); margin-top: 0.75rem;">
             avanzado de préstamos de autos deportivos y de alta gama
        </p>
    </div>
    <div class="container mb-5">
        <div class="row justify-content-center g-4">
           
           
        </div>
    </div>
    <hr class="mb-4">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div id="tablaUsuarios" style="display: none;">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellidos</th> 
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                             <td>{{ $user->apellidos ?? '-' }}</td> 
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge bg-secondary text-capitalize">{{ $user->rol }}</span>
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if(auth()->user()->rol !== 'funcionario')
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">Editar</a>

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    </form>
                                @else
                                    <span class="text-muted">Sin acciones</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
        document.getElementById('mainContent').classList.toggle('active');
    });

    function toggleUsuarios() {
        var tabla = document.getElementById("tablaUsuarios");
        tabla.style.display = tabla.style.display === "none" ? "block" : "none";
    }
</script>
@endsection
