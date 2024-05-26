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
        Schema::create('contrat_assurances', function (Blueprint $table) {
            $table->id();
            $table->string('taux_couverture');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->foreignId('tarif_consultation_id')->constrained();
            $table->foreignId('maison_assurance_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrat_assurances');
    }
};
