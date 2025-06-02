<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SorprendemeController extends Controller
{
    public function index()
    {
        // Préstamos por mes
        $prestamosPorMes = DB::table('prestamos')
            ->selectRaw("DATE_FORMAT(fecha_inicio, '%M') as mes, COUNT(*) as cantidad")
            ->groupBy('mes')
            ->pluck('cantidad', 'mes')
            ->toArray();

        $labels = array_keys($prestamosPorMes);
        $data = array_values($prestamosPorMes);

        // Top 5 insumos más solicitados
        $topInsumos = DB::table('prestamos')
            ->join('insumos', 'prestamos.insumo_id', '=', 'insumos.id')
            ->select('insumos.nombre', DB::raw('COUNT(*) as cantidad'))
            ->groupBy('insumos.nombre')
            ->orderByDesc('cantidad')
            ->limit(5)
            ->get();

        $topLabels = $topInsumos->pluck('nombre');
        $topData = $topInsumos->pluck('cantidad');

        return view('dashboard.sorprendeme', compact('labels', 'data', 'topLabels', 'topData'));
    }
}
