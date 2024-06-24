<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    protected $model = Campaign::class;

    public function definition()
    {
        return [
            'codigo' => $this->faker->word,
            'tematica' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'fecha_inicio' => $this->faker->date,
            'fecha_final' => $this->faker->date,
            'descripcion' => $this->faker->paragraph,
            'company_id' => Company::factory(),
            // Agrega aquí otros campos necesarios para la campaña
        ];
    }
}
