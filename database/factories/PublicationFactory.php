<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Publication;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Publication>
 */
class PublicationFactory extends Factory
{
    protected $model = Publication::class;

    public function definition(): array
    {
        return [
            'codigo' => $this->faker->word,
            'titulo' => $this->faker->sentence,
            'presupuesto' => $this->faker->randomFloat(2, 0, 1000),
            'fecha_publicacion' => $this->faker->date,
            'hora_publicacion' => $this->faker->time,
            'contenido' => $this->faker->paragraph,
            'descripcion_recurso' => $this->faker->paragraph,
            'estado' => $this->faker->randomElement(['Borrador', 'Publicado']),
            'campaign_id' => Campaign::factory(),
        ];
    }
}
