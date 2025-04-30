<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Asegúrate de que este namespace es correcto según tu estructura
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('admin123'),
            'rol' => 'administrador',
        ]);

        User::create([
            'name' => 'Supervisor Juan',
            'email' => 'juan@empresa.com',
            'password' => Hash::make('supervisor123'),
            'rol' => 'supervisor',
        ]);

        $this->call(AdminVitalicioSeeder::class);
        $this->call(ModeloVehiculoSeeder::class);
    }
}
