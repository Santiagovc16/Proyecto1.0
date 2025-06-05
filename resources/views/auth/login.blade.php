@extends('layouts.app')
<style>
    :root {
        --primary: #6e45e2;
        --secondary: #88d3ce;
        --dark: #1a1a2e;
        --light: #f8f9fa;
    }

    body {
        background: linear-gradient(135deg, var(--dark), #16213e);
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
        margin: 0;
        overflow-x: hidden;
        color: var(--light);
        display: flex;
        justify-content: center;
        align-items: center;
        perspective: 1000px;
    }

    .login-container {
        position: relative;
        width: 380px;
        z-index: 10;
    }

    .neon-card {
        background: rgba(26, 26, 46, 0.8);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        transform-style: preserve-3d;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .neon-card:hover {
        transform: translateY(-10px) rotateX(5deg);
        box-shadow: 0 35px 60px rgba(110, 69, 226, 0.3);
    }

    .neon-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            45deg,
            transparent,
            rgba(110, 69, 226, 0.1),
            transparent
        );
        transform: rotate(45deg);
        animation: shine 6s infinite;
        pointer-events: none; /* Esto soluciona el problema de interacción */
    }

    @keyframes shine {
        0% { transform: rotate(45deg) translate(-30%, -30%); }
        100% { transform: rotate(45deg) translate(30%, 30%); }
    }

    .logo-container {
        text-align: center;
        margin-bottom: 30px;
        position: relative;
    }

    .logo-img {
        width: 120px;
        height: 120px;
        object-fit: contain;
        filter: drop-shadow(0 0 15px rgba(110, 69, 226, 0.7));
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(2deg); }
    }

    h2 {
        text-align: center;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        position: relative;
    }

    h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        border-radius: 3px;
    }

    .input-group {
        position: relative;
        margin-bottom: 25px;
    }

    .input-group input {
        width: 100%;
        padding: 15px 20px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: var(--light);
        font-size: 16px;
        transition: all 0.3s;
        z-index: 2; /* Asegura que los inputs estén sobre otros elementos */
        position: relative;
    }

    .input-group input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(110, 69, 226, 0.3);
        background: rgba(255, 255, 255, 0.1);
    }

    .input-group label {
        position: absolute;
        top: 15px;
        left: 20px;
        color: rgba(255, 255, 255, 0.7);
        font-size: 16px;
        transition: all 0.3s;
        pointer-events: none;
        z-index: 3;
    }

    .input-group input:focus + label,
    .input-group input:not(:placeholder-shown) + label {
        top: -10px;
        left: 10px;
        font-size: 12px;
        background: var(--dark);
        padding: 0 5px;
        color: var(--secondary);
    }

    .btn-login {
        width: 100%;
        padding: 15px;
        background: linear-gradient(45deg, var(--primary), var(--secondary));
        border: none;
        border-radius: 10px;
        color: white;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-login::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, var(--secondary), var(--primary));
        transition: all 0.4s;
        z-index: -1;
    }

    .btn-login:hover::before {
        left: 0;
    }

    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(110, 69, 226, 0.4);
    }

    .particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
        pointer-events: none; /* Esto evita que las partículas interfieran */
    }

    .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        animation: float-particle linear infinite;
        pointer-events: none; /* Esto evita que las partículas interfieran */
    }

    @keyframes float-particle {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(-1000px) rotate(720deg);
            opacity: 0;
        }
    }
</style>

@section('content')
<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="login-container">
    <!-- Efecto de partículas -->
    <div class="particles" id="particles"></div>

    <div class="neon-card">
        <div class="logo-container">
            <img src="{{ asset('img/calidad_db.png') }}" alt="Logo Calidad DB" class="logo-img">
        </div>

        <h2>Iniciar Sesión</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf

            <div class="input-group">
                <input type="email" name="email" id="email" placeholder=" " required>
                <label for="email">Correo electrónico</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" id="password" placeholder=" " required>
                <label for="password">Contraseña</label>
            </div>

            <button type="submit" class="btn-login">Ingresar</button>
        </form>
    </div>
    </div>
</div>

<script>
    // Efecto de partículas dinámicas
    document.addEventListener('DOMContentLoaded', function() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = 30;
        
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');
            
            // Tamaño aleatorio entre 2px y 6px
            const size = Math.random() * 4 + 2;
            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            
            // Posición inicial aleatoria
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.bottom = `-10px`;
            
            // Duración de animación aleatoria
            const duration = Math.random() * 15 + 10;
            particle.style.animationDuration = `${duration}s`;
            
            // Retraso aleatorio
            particle.style.animationDelay = `${Math.random() * 5}s`;
            
            // Opacidad aleatoria
            particle.style.opacity = Math.random() * 0.5 + 0.1;
            
            particlesContainer.appendChild(particle);
        }
    });

    // Efecto de movimiento 3D al mover el mouse
    const card = document.querySelector('.neon-card');
    document.addEventListener('mousemove', (e) => {
        const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
        const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
        card.style.transform = `translateY(-10px) rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
    });

    // Resetear cuando el mouse sale
    document.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) rotateY(0deg) rotateX(0deg)';
    });
</script>
@endsection