<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreditOffer;

class CreditOfferSeeder extends Seeder
{
    public function run(): void
    {
        CreditOffer::factory(10)->create();
    }
}