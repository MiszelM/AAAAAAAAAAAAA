<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pracowniks', function (Blueprint $table) {
        $table->id(); // Odpowiednik IdPracownika
        $table->string('imie', 20);
        $table->string('nazwisko', 20);
        $table->string('email', 50);
        $table->string('nr_telefonu', 20);
        $table->smallInteger('wynik_bonusu')->default(0);
        $table->string('stanowisko', 20);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pracowniks');
    }
};
