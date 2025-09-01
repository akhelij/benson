<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'reference' => 'ART-' . $this->faker->unique()->numberBetween(1000, 9999),
            'nom' => $this->faker->words(3, true),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
