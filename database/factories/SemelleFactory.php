<?php

namespace Database\Factories;

use App\Models\Semelle;
use Illuminate\Database\Eloquent\Factories\Factory;

class SemelleFactory extends Factory
{
    protected $model = Semelle::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->randomElement(['Cuir', 'Caoutchouc', 'Gomme', 'Crêpe', 'Vibram']) . ' ' . $this->faker->numberBetween(1, 10) . 'mm',
        ];
    }
}
