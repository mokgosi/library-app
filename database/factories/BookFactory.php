<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->catchPhrase(),
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'isbn' => $this->faker->isbn13(),
            'category_id' => rand(1,10),
            'copies' => rand(1,5),
        ];

    }
}
