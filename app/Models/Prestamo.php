<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'insumo_id', 'estado', 'fecha_inicio', 'fecha_fin'];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}