@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(145deg, #d7dde8, #a3b4c8);
        min-height: 100vh;
        font-family: 'Titillium Web', sans-serif;
        background-attachment: fixed;
    }
    .header-box {
        background: linear-gradient(135deg, #1b1f33, #2e3a59);
        padding: 3rem 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        max-width: 820px;
        margin: 0 auto 3rem auto;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        background: #101820;
        padding: 20px;
        border-right: 2px solid #4DD0E1;
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
        font-weight: bold;
        color: #FFD700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #444;
        padding-bottom: 5px;
    }

    .sidebar-section a {
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        color: #b0c4ff;
        font-size: 0.95rem;
        padding: 8px 14px;
        border-radius: 6px;
        background: linear-gradient(145deg, #1b1f33, #2e3a59);
        box-shadow: 0 2px 5px rgba(0,0,0,0.25);
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .sidebar-section a:hover {
        background: linear-gradient(145deg, #00f2ff, #007a99);
        color: #101820;
        box-shadow: 0 0 10px rgba(0, 224, 255, 0.5), 0 0 20px rgba(0, 224, 255, 0.3);
        border: 1px solid rgba(0, 224, 255, 0.5);
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
    .car-image {
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    .car-image:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 30px rgba(0, 224, 255, 0.25);
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
        <h6>📦 Administración de Insumos</h6>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ route('insumos.bandeja') }}">🖥️ Bandeja de Insumos</a>
            <a href="{{ route('insumos.index') }}">📋 Ver Todos los Insumos</a>
        @else
            <a class="disabled">🔒 Bandeja de Insumos</a>
            <a class="disabled">🔒 Ver Insumos</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6>📄 Solicitudes de Préstamo</h6>
        <a href="{{ url('/prestamos/create') }}">➕ Crear Préstamo</a>
        <a href="{{ url('/prestamos') }}">🆕 Nuevas Solicitudes</a>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ url('/admin/prestamos') }}">🗂️ Aprobación</a>
        @else
            <a class="disabled">🔒 Aprobación</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6>👥 Administración de Usuarios</h6>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ route('users.create') }}">👤 Crear Usuario</a>
            <a href="#" onclick="toggleUsuarios()">👥 Mostrar/Ocultar Usuarios</a>
        @else
            <a class="disabled">🔒 Crear Usuario</a>
        @endif
    </div>

    <div class="sidebar-section">
        <h6>📊 Generación de Reportes</h6>
        @if(in_array(auth()->user()->rol, ['administrador', 'supervisor']))
            <a href="{{ route('reportes.insumos') }}">📦 Reporte de Insumos</a>
            <a href="{{ route('reportes.prestamos') }}">📁 Reporte de Préstamos</a>
            <a href="{{ route('reportes.disponibles') }}">📍 Insumos Disponibles</a>
        @else
            <a class="disabled">🔒 Acceso a Reportes</a>
        @endif
    </div>
</div>

<div id="mainContent">
    <div class="header-box">
        <h1 style="font-size: 3rem; font-weight: 800; color: #00e0ff; text-shadow: 0 0 10px rgba(0, 224, 255, 0.7);">
             Sistema de Gestión Vehicular
        </h1>
        <p style="font-size: 1.25rem; color: #e0e6ed; margin-top: 0.75rem;">
            Control avanzado de préstamos de autos deportivos y de alta gama
        </p>
    </div>
    <div class="container mb-5">
        <div class="row justify-content-center g-4">
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/autos/ferrari.jpg') }}" alt="Ferrari" class="car-image" style="width: 100%; max-width: 300px; border-radius: 12px; object-fit: cover;">
                <div style="margin-top: 0.5rem; font-weight: 600; color: #e74c3c;"></div>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{ asset('img/autos/lamborghini.jpg') }}" alt="Lamborghini" class="car-image" style="width: 100%; max-width: 300px; border-radius: 12px; object-fit: cover;">
                <div style="margin-top: 0.5rem; font-weight: 600; color: #f1c40f;"></div>
            </div>
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
