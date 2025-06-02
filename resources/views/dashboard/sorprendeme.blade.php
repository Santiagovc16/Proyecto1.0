{{-- resources/views/dashboard/sorprendeme.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1 class="text-primary">📈 Visualización de Datos de Préstamos</h1>
    <p>Bienvenido al módulo de visualización avanzada.</p>
</div>


<div class="mt-3">
    <h3 class="text-info">📊 Insumos Prestados por Mes</h3>
    <canvas id="prestamosChart" height="60"></canvas>
</div>

<h3 class="text-warning mt-5">🏆 Top 5 Insumos Más Solicitados</h3>
<div class="d-flex justify-content-center mt-4">
    <div style="max-width: 400px;">
        <canvas id="topInsumosChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('prestamosChart').getContext('2d');
    const prestamosChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Préstamos',
                data: @json($data),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                barThickness: 20,
            }]
        },
        options: {
            animation: {
                duration: 1000,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#000',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed} préstamos`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        callback: function(value) {
                            return Number.isInteger(value) ? value : '';
                        }
                    }
                }
            }
        }
    });
    const ctxTop = document.getElementById('topInsumosChart').getContext('2d');
    const topInsumosChart = new Chart(ctxTop, {
        type: 'pie',
        data: {
            labels: @json($topLabels ?? []),
            datasets: [{
                label: 'Cantidad de Préstamos',
                data: @json($topData ?? []),
                backgroundColor: [
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(153, 102, 255, 0.6)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: true,
            responsive: true,
            animation: {
                duration: 1000,
                easing: 'easeOutBounce'
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#000',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.parsed} préstamos`;
                        }
                    }
                }
            }
        }
    });
</script>

<div class="text-center mt-5 mb-4">
    <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
        ⬅ Volver al Menú Principal
    </a>
</div>

@endsection
