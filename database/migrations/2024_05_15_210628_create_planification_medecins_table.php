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
        Schema::create('planification_medecins', function (Blueprint $table) {
            $table->id();
            $table->date('jour_semaine');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->foreignId('medecin_id')->constrained();
            $table->foreignId('tarif_medical_id')->constrained();
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
        Schema::dropIfExists('planification_medecins');
    }
};
