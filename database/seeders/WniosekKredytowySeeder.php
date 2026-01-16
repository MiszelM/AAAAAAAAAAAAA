<?php

namespace Database\Seeders;

use App\Models\WniosekKredytowy;
use Illuminate\Database\Seeder;

class WniosekKredytowySeeder extends Seeder
{
    public function run(): void
    {
        WniosekKredytowy::factory()->count(30)->create();
    }
}