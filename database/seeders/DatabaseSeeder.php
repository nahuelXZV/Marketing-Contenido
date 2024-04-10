<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call([RoleSeeder::class]);

        $company = Company::create([
            'nombre' => 'Camerata del oriente',
            'direccion' => 'Calle Principal #123',
            'telefono' => '656955852',
            'correo' => 'camerata-oriente@gmail.com',
            'foto' => '',
            'logo' => '',
            'slogan' => 'La mejor orquesta de la región',
            'descripcion' => 'La orquesta sinfónica del oriente es una orquesta sinfónica de la región del oriente de El Salvador, fundada en 1990 por el maestro Juan Pérez. La orquesta ha sido reconocida por su calidad y profesionalismo en la interpretación de música clásica y contemporánea.',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'example@live.com',
            'password' => bcrypt('12345678'),
            'company_id' => $company->id,
        ])->assignRole('Administrador');
    }
}
