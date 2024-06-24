<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->word,
            'telefono' => $this->faker->phoneNumber,
            'correo' => $this->faker->email,
            'direccion' => $this->faker->address,
            'foto' => $this->faker->imageUrl(),
            'logo' => $this->faker->imageUrl(),
            'slogan' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
        ];
    }
}
