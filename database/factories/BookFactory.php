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
            'phone' => $this->faker->e164PhoneNumber(),
            'isbn' => $this->faker->isbn13(),
            'category_id' => rand(1,10),
            'no_of_issues' => rand(1,5)
        ];

    }
}
