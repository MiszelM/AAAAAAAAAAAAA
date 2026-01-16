<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kredyt>
 */
class KredytFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        'klient_id' => \App\Models\Klient::factory(),
        'pracownik_id' => \App\Models\Pracownik::factory(),
        'credit_offer_id' => \App\Models\CreditOffer::factory(),
        'wniosek_kredytowy_id' => \App\Models\WniosekKredytowy::factory(),
        'data_zawarcia' => now(),
        'numer_umowy' => 'KRE/' . $this->faker->unique()->numberBetween(1000, 9999) . '/' . now()->year,
        'postanowienia_umowy' => $this->faker->paragraph(3),
        'kwota_wydana' => $this->faker->randomFloat(2, 5000, 100000),
        'kwota_odsetek' => $this->faker->randomFloat(2, 1000, 20000),
        'data_wydania' => now()->addDays(2),
        'tytul_kredytu' => $this->faker->randomElement(['Kredyt Gotówkowy', 'Zakup Samochodu', 'Remont']),
        'termin_splaty' => now()->addYears(5),
        'liczba_rat' => $this->faker->randomElement([12, 24, 36, 48, 60]),
        'nr_rachunku_do_wplat' => $this->faker->bankAccountNumber(),
        'uwagi' => $this->faker->optional()->sentence(),
    ];
    }
}
