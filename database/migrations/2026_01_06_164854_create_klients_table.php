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
    Schema::create('klients', function (Blueprint $table) {
        $table->id(); // Odpowiednik IdKlienta
        $table->string('imie', 50);
        $table->string('nazwisko', 50);
        $table->string('nazwa_firmy', 100)->nullable();
        $table->string('ulica', 100);
        $table->string('nr_domu', 100);
        $table->smallInteger('nr_lokalu')->nullable();
        $table->string('miejscowosc', 100);
        $table->string('nr_telefonu', 20);
        $table->string('email', 254)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klients');
    }
};
