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
        Schema::create('entrepot_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nom_entrepot');
            $table->string('adresse_entrepot')->nullable();
            $table->string('capacite_entrepot')->nullable();
            $table->string('agence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrepot_stocks');
    }
};
