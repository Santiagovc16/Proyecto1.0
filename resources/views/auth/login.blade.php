@extends('layouts.app')
<style>
    body {
        background: linear-gradient(to right, #e0eafc, #cfdef3);
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    h2.mb-4 {
        text-align: center;
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 2rem;
    }

    .login-form-wrapper {
        max-width: 420px;
        margin: 0 auto;
        margin-top: 3rem;
        padding: 2.5rem;
        background-color: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .login-form-wrapper .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control {
        border-radius: 0.5rem;
        height: 45px;
        font-size: 1rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        font-weight: 600;
        height: 45px;
        font-size: 1rem;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .alert {
        max-width: 420px;
        margin: 0 auto 1.5rem auto;
    }
</style>

@section('content')
    <h2 class="mb-4">Iniciar Sesión</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST" class="login-form-wrapper">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" placeholder="usuario@correo.com" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="••••••" required>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
@endsection
