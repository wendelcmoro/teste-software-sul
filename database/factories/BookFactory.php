<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = \App\Models\Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'author' => $this->faker->name,
            'description' => $this->faker->sentence,
            'isbn' => $this->faker->isbn13,
            'quantity_available' => $this->faker->numberBetween(1, 10),
        ];
    }
}
