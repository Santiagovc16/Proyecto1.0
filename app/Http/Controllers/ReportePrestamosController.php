<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportePrestamosController extends Controller
{
    public function generarPDF()
    {
        $prestamos = Prestamo::with('usuario', 'insumo')->get();
        $pdf = Pdf::loadView('reportes.prestamos', compact('prestamos'));
        return $pdf->download('reporte_prestamos.pdf');
    }
}
