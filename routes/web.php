<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InsumoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ReportePrestamosController;
use App\Http\Controllers\SorprendemeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Ruta raíz: redirige al login (para evitar error 404 en tests)
Route::get('/', function () {
    return redirect()->route('login');
});

// 🔐 Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🔒 Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('insumos', InsumoController::class);
    Route::get('/bandeja', [InsumoController::class, 'bandeja'])->name('insumos.bandeja');
    
    Route::get('/reportes/insumos', [ReporteController::class, 'reporteInsumos'])->name('reportes.insumos');
    Route::get('/reportes/prestamos', [ReporteController::class, 'reportePrestamos'])->name('reportes.prestamos');
    Route::get('/reportes/disponibles', [ReporteController::class, 'reporteDisponibles'])->name('reportes.disponibles');

    Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::get('/prestamos/create', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::post('/prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
    Route::get('/prestamos/pdf', [ReportePrestamosController::class, 'generarPDF'])->name('reporte.prestamos.pdf');
    Route::get('/admin/prestamos', [PrestamoController::class, 'adminIndex'])->name('prestamos.admin');
    Route::post('/admin/prestamos/{prestamo}/estado', [PrestamoController::class, 'cambiarEstado'])->name('prestamos.estado');

    Route::get('/dashboard/sorprendeme', [SorprendemeController::class, 'index'])->name('dashboard.sorprendeme');
});
