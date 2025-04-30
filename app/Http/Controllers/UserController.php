<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        if (auth()->user()->rol === 'funcionario') {
            return redirect()->route('users.index')->with('error', 'Acceso denegado');
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->rol === 'funcionario') {
            return redirect()->route('users.index')->with('error', 'No tienes permiso para crear usuarios.');
        }

        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u'],
            'apellidos' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u'],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'rol' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
               
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        if (auth()->user()->rol === 'funcionario') {
            abort(403, 'No tienes permiso para editar usuarios.');
        }

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->rol === 'funcionario') {
            return redirect()->route('users.index')->with('error', 'No tienes permiso para actualizar usuarios.');
        }

        $request->validate([
            'name' => ['required', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/u'],
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|min:6',
            'rol' => 'required',

        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->rol = $request->rol;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (auth()->user()->rol === 'funcionario') {
            return redirect()->route('users.index')->with('error', 'No tienes permiso para eliminar usuarios.');
        }

        $user = User::findOrFail($id);
        if ($user->email === 'santi_3007@hotmail.com') {
            return redirect()->route('users.index')->with('error', '⚠️ Este usuario no puede ser eliminado.');
        }
        User::destroy($id);
        return back()->with('success', 'Usuario eliminado correctamente.');
    }
}