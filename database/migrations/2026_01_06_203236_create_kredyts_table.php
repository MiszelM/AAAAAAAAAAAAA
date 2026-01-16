<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kredyts', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('klient_id')->constrained('klients');
            $table->foreignId('pracownik_id')->constrained('pracowniks');
            $table->foreignId('credit_offer_id')->constrained('credit_offers');
            $table->foreignId('wniosek_kredytowy_id')->nullable()->constrained('wniosek_kredytowies');
            $table->date('data_zawarcia');
            $table->string('numer_umowy', 20);
            $table->text('postanowienia_umowy'); 
            $table->decimal('kwota_wydana', 15, 2);
            $table->decimal('kwota_odsetek', 15, 2);
            $table->date('data_wydania');
            $table->string('tytul_kredytu', 50);
            $table->date('termin_splaty');
            $table->smallInteger('liczba_rat');
            $table->string('nr_rachunku_do_wplat', 30);
            $table->string('uwagi', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kredyts');
    }
};