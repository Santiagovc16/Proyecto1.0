<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Models\ModeloVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!in_array(Auth::user()->rol, ['administrador', 'supervisor'])) {
                return redirect()->route('users.index')->with('error', 'Acceso denegado');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $insumos = Insumo::all();
        return view('insumos.index', compact('insumos'));
    }

    public function create()
    {
        $modelos = ModeloVehiculo::all();
        return view('insumos.create', compact('modelos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|string',
            'marca' => 'required|string|max:255',
        ]);

        $modelo = ModeloVehiculo::where('nombre', $request->nombre)->first();

        if ($modelo && $modelo->registrados >= $modelo->stock_maximo) {
            return back()->with('error', 'Ya no puedes registrar más unidades de este modelo.');
        }

        $modeloMarcaMap = [
            'CX-30' => 'Mazda',
            'Sportage' => 'Kia',
            'Fiesta' => 'Ford',
            'F40' => 'Ferrari',
            'Hilux' => 'Toyota',
            'Onix' => 'Chevrolet',
            'Serie 3' => 'BMW',
            'Aventador SVJ' => 'Lamborghini',
            'Tucson' => 'Hyundai',
        ];

        if (isset($modeloMarcaMap[$request->nombre]) && $modeloMarcaMap[$request->nombre] !== $request->marca) {
            return back()->with('error', 'La marca no coincide con el modelo seleccionado.')->withInput();
        }

        Insumo::create([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'estado' => $request->estado,
        ]);

        if ($modelo) {
            $modelo->increment('registrados');
        }

        return redirect()->route('insumos.index')->with('success', 'Insumo creado correctamente');
    }

    public function edit(Insumo $insumo)
    {
        $modelos = ModeloVehiculo::all();
        return view('insumos.edit', compact('insumo', 'modelos'));
    }

    public function update(Request $request, Insumo $insumo)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cantidad' => 'required|integer|min:1',
            'estado' => 'required|string',
            'marca' => 'required|string|max:255',
        ]);

        $nombreAnterior = $insumo->nombre;
        $nombreNuevo = $request->nombre;

        if ($nombreAnterior !== $nombreNuevo) {
            $modeloAnterior = ModeloVehiculo::where('nombre', $nombreAnterior)->first();
            $modeloNuevo = ModeloVehiculo::where('nombre', $nombreNuevo)->first();

            if ($modeloAnterior && $modeloAnterior->registrados > 0) {
                $modeloAnterior->decrement('registrados');
            }

            if ($modeloNuevo && $modeloNuevo->registrados < $modeloNuevo->stock_maximo) {
                $modeloNuevo->increment('registrados');
            }
        }

        $insumo->update([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'descripcion' => $request->descripcion,
            'cantidad' => $request->cantidad,
            'estado' => $request->estado,
        ]);

        return redirect()->route('insumos.index')->with('success', 'Insumo actualizado correctamente');
    }

    public function destroy(Insumo $insumo)
    {
        $insumo->delete();
        $modelo = ModeloVehiculo::where('nombre', $insumo->nombre)->first();
        if ($modelo && $modelo->registrados > 0) {
            $modelo->decrement('registrados');
        }
        return redirect()->route('insumos.index')->with('success', 'Insumo eliminado');
    }

    public function bandeja(Request $request)
    {
        $nombre = $request->input('nombre');
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');

        $query = \App\Models\Insumo::query();

        if ($nombre) {
            $query->where('nombre', 'like', "%{$nombre}%");
        }

        if ($fechaInicio && $fechaFin) {
            $query->whereBetween('created_at', [$fechaInicio, $fechaFin]);
        }

        $todos = $query->get();

        $disponibles = $todos->where('estado', 'disponible');
        $prestados = $todos->where('estado', 'prestado');
        $averiados = $todos->where('estado', 'averiado');

        return view('insumos.bandeja', compact('disponibles', 'prestados', 'averiados', 'nombre', 'fechaInicio', 'fechaFin'));
    }
}