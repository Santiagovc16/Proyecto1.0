<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeloVehiculoSeeder extends Seeder
{
    public function run()
    {
        DB::table('modelo_vehiculos')->insert([
            ['nombre' => 'CX-30'],
            ['nombre' => 'Sportage'],
            ['nombre' => 'Fiesta'],
            ['nombre' => 'F40'],
            ['nombre' => 'Hilux'],
            ['nombre' => 'Onix'],
            ['nombre' => 'Serie 3'],
            ['nombre' => 'Aventador SVJ'],
            ['nombre' => 'Tucson'],
        ]);
    }
}
