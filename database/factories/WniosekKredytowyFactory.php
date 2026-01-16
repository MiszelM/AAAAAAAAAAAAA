<?php

namespace Database\Factories;

use App\Models\WniosekKredytowy;
use App\Models\Klient;
use App\Models\Pracownik;
use App\Models\CreditOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class WniosekKredytowyFactory extends Factory
{
    protected $model = WniosekKredytowy::class;

    public function definition(): array
    {
        return [
            // Losujemy ID z istniejących już rekordów w bazie
            'klient_id' => Klient::inRandomOrder()->first()?->id ?? Klient::factory(),
            'pracownik_id' => Pracownik::inRandomOrder()->first()?->id ?? Pracownik::factory(),
            'credit_offer_id' => CreditOffer::inRandomOrder()->first()?->id ?? CreditOffer::factory(),
            
            'data_zlozenia' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'data_rozpatrzenia' => $this->faker->optional(0.7)->dateTimeBetween('now', '+1 month'),
            'wnioskowana_kwota' => $this->faker->randomFloat(2, 5000, 150000),
            'uwagi' => $this->faker->sentence(),
        ];
    }
}