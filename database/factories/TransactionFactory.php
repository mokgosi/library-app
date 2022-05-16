<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'member_id' => rand(1,10),
            'book_id' => rand(1,100),
            'date_issued' => $this->faker->dateTimeBetween('-1 week'),
            'date_due' => $this->faker->dateTimeBetween('-1 week', '+1 week'),
            'date_returned' => null,
            'status' => 'Pending',
            'penalty' => '0.00',
            'transaction_id' => 'TRANS-'.$this->faker->numerify('#######'),
        ];

    }
}
