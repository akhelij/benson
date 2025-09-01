<?php

namespace Database\Factories;

use App\Models\Doublure;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoublureFactory extends Factory
{
    protected $model = Doublure::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->randomElement(['Cuir', 'Tissu', 'Synthétique', 'Coton', 'Soie']) . ' ' . $this->faker->colorName(),
        ];
    }
}
