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
        Schema::create('ocenas', function (Blueprint $table) {
        $table->id(); 
        $table->foreignId('wniosek_kredytowy_id')->constrained('wniosek_kredytowies');
        $table->date('data_oceny');
        $table->decimal('dochody', 15, 2);
        $table->smallInteger('okres_zatrudnienia');
        $table->tinyInteger('liczba_osob');
        $table->decimal('wydatki_stale', 15, 2);
        $table->decimal('miesz_zobowiazania', 15, 2);
        $table->decimal('reszta', 15, 2);
        $table->smallInteger('wynik_kredytowy');
        $table->string('uwagi', 100);
        $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocenas');
    }
};
