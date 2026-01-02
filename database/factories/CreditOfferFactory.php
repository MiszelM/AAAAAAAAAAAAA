<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CreditOfferFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Kredyt ' . fake()->word(),
            'interest_rate' => fake()->randomFloat(2, 2, 8),
            'rrso' => fake()->randomFloat(2, 3, 10),
            'min_credit_score' => fake()->numberBetween(400, 900),
            'worker_bonus' => fake()->numberBetween(200, 1000),
        ];
    }
}