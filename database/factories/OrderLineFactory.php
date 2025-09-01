<?php

namespace Database\Factories;

use App\Models\OrderLine;
use App\Models\Order;
use App\Models\Article;
use App\Models\Cuir;
use App\Models\Doublure;
use App\Models\Semelle;
use App\Models\Construction;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderLineFactory extends Factory
{
    protected $model = OrderLine::class;

    public function definition(): array
    {
        $sizes = [
            'p5' => $this->faker->numberBetween(0, 10),
            'p5x' => $this->faker->numberBetween(0, 10),
            'p6' => $this->faker->numberBetween(0, 10),
            'p6x' => $this->faker->numberBetween(0, 10),
            'p7' => $this->faker->numberBetween(0, 10),
            'p7x' => $this->faker->numberBetween(0, 10),
            'p8' => $this->faker->numberBetween(0, 10),
            'p8x' => $this->faker->numberBetween(0, 10),
            'p9' => $this->faker->numberBetween(0, 10),
            'p9x' => $this->faker->numberBetween(0, 10),
            'p10' => $this->faker->numberBetween(0, 10),
            'p10x' => $this->faker->numberBetween(0, 10),
            'p11' => $this->faker->numberBetween(0, 10),
            'p11x' => $this->faker->numberBetween(0, 10),
            'p12' => $this->faker->numberBetween(0, 10),
            'p13' => $this->faker->numberBetween(0, 10),
        ];
        
        return array_merge([
            'order_id' => Order::factory(),
            'article_id' => Article::factory(),
            'forme' => 'F-' . $this->faker->numberBetween(100, 999),
            'cuir_id' => Cuir::factory(),
            'doublure_id' => Doublure::factory(),
            'semelle_id' => Semelle::factory(),
            'construction_id' => Construction::factory(),
            'prix' => $this->faker->randomFloat(2, 50, 500),
            'supplements' => $this->faker->optional()->sentence(),
            'total_quantity' => array_sum(array_filter($sizes)),
        ], $sizes);
    }
}
