<?php

namespace Database\Factories;

use App\Models\Cuir;
use Illuminate\Database\Eloquent\Factories\Factory;

class CuirFactory extends Factory
{
    protected $model = Cuir::class;

    public function definition(): array
    {
        return [
            'nom' => $this->faker->unique()->randomElement(['Veau', 'Agneau', 'Chèvre', 'Porc', 'Vachette']) . ' ' . $this->faker->colorName(),
        ];
    }
}
