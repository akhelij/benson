<?php

namespace Database\Factories;

use App\Models\Construction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConstructionFactory extends Factory
{
    protected $model = Construction::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->randomElement(['Blake', 'Goodyear', 'Norwegian', 'Bologna', 'Mocassin']) . ' ' . $this->faker->optional()->word(),
        ];
    }
}
