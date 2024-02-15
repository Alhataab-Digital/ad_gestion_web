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
        Schema::create('devise_agences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('devise_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->float('taux');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devise_agences');
    }
};
