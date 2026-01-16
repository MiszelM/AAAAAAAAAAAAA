<?php

namespace Database\Factories;

use App\Models\Ocena;
use App\Models\WniosekKredytowy;
use Illuminate\Database\Eloquent\Factories\Factory;

class OcenaFactory extends Factory
{
    protected $model = Ocena::class;

    public function definition(): array
    {
        $dochody = $this->faker->randomFloat(2, 4000, 15000);
        $wydatki = $this->faker->randomFloat(2, 500, 1500);
        $zobowiazania = $this->faker->randomFloat(2, 0, 2000);

        return [
            // To pole jest wymagane przez bazę danych!
            'wniosek_kredytowy_id' => WniosekKredytowy::inRandomOrder()->first()?->id ?? WniosekKredytowy::factory(),
            'data_oceny' => now(),
            'dochody' => $dochody,
            'okres_zatrudnienia' => $this->faker->numberBetween(6, 120),
            'liczba_osob' => $this->faker->numberBetween(1, 5),
            'wydatki_stale' => $wydatki,
            'miesz_zobowiazania' => $zobowiazania,
            'reszta' => $dochody - $wydatki - $zobowiazania,
            'wynik_kredytowy' => $this->faker->numberBetween(300, 850),
            'uwagi' => 'Generowane automatycznie',
        ];
    }
}