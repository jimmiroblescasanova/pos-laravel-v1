<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        settings()->set('app_name', 'PuntoDeVenta');
        
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@inventarionube.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('admin');

        $this->call([
            NewRolesSeeder::class,
        ]);

    }
}
