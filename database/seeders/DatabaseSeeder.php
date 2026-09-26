<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Usuario Administrador
        User::create([
            'name' => 'Administrador Despacho',
            'email' => 'admin@despacho.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'hourly_cost' => 150.00,
        ]);

        // Usuario Supervisor
        User::create([
            'name' => 'Supervisor Contable',
            'email' => 'supervisor@despacho.com',
            'password' => Hash::make('12345678'),
            'role' => 'supervisor',
            'hourly_cost' => 100.00,
        ]);

        // Usuario Contador Operador
        User::create([
            'name' => 'Contador Junior',
            'email' => 'contador@despacho.com',
            'password' => Hash::make('12345678'),
            'role' => 'contador',
            'hourly_cost' => 60.00,
        ]);
    }
}
