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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('medecin_id')->constrained();
            $table->foreignId('planification_id')->constrained();
            $table->foreignId('tarif_medical_id')->constrained();
            $table->string('motif')->nullable();
            $table->text('examen_clinique')->nullable();
            $table->text('examen_biologique')->nullable();
            $table->text('examen_radiologique')->nullable();
            $table->text('diagnostique')->nullable();
            $table->text('traitement')->nullable();
            $table->text('etat')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
