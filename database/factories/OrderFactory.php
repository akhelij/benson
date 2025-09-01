<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'code' => 'ORD-' . $this->faker->unique()->numberBetween(1000, 9999),
            'firm' => $this->faker->company(),
            'ville' => $this->faker->city(),
            'telephone' => $this->faker->phoneNumber(),
            'livraison' => $this->faker->dateTimeBetween('now', '+30 days'),
            'transporteur' => $this->faker->randomElement(['DHL', 'FedEx', 'UPS', 'TNT']),
            'status' => $this->faker->randomElement(['draft', 'confirmed', 'in_production', 'delivered', 'cancelled']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
