<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Klient>
 */
class KlientFactory extends Factory
{
    
    public function definition(): array
{
    return [
        'imie' => fake()->firstName(),
        'nazwisko' => fake()->lastName(),
        'nazwa_firmy' => fake()->optional()->company(),
        'ulica' => fake()->streetName(),
        'nr_domu' => fake()->buildingNumber(),
        'nr_lokalu' => fake()->optional()->numberBetween(1, 100),
        'miejscowosc' => fake()->city(),
        'nr_telefonu' => '+48 ' . fake()->numerify('### ### ###'), // Format z Twojego CK
        'email' => fake()->optional()->safeEmail(),
    ];
}
}
