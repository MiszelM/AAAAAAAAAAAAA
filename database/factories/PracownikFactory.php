<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pracownik>
 */
class PracownikFactory extends Factory
{
    
    
    public function definition(): array
    {
    return [
        'imie' => fake()->firstName(),
        'nazwisko' => fake()->lastName(),
        'email' => fake()->unique()->safeEmail(),
        'nr_telefonu' => '+48 ' . fake()->numerify('### ### ###'),
        'wynik_bonusu' => fake()->numberBetween(0, 1000),
        'stanowisko' => fake()->randomElement(['Doradca', 'Manager', 'Analityk']),
    ];
}
}
