<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('credit_offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('interest_rate', 5, 2);
            $table->decimal('rrso', 5, 2);
            $table->integer('min_credit_score');
            $table->integer('worker_bonus');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('credit_offers');
    }
};

