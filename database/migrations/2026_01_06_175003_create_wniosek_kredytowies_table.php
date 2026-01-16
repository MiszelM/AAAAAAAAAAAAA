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
    Schema::create('wniosek_kredytowies', function (Blueprint $table) {
        $table->id(); // Odpowiednik IdWniosekKredytowy
        
        // Relacje (Klucze obce)
        $table->foreignId('klient_id')->constrained('klients')->onDelete('cascade');
        $table->foreignId('pracownik_id')->constrained('pracowniks')->onDelete('cascade');
        $table->foreignId('credit_offer_id')->constrained('credit_offers')->onDelete('cascade');
        
        // Dane wniosku
        $table->date('data_zlozenia');
        $table->date('data_rozpatrzenia')->nullable();
        $table->decimal('wnioskowana_kwota', 15, 2); // Odpowiednik MONEY
        $table->text('uwagi')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wniosek_kredytowies');
    }
};
