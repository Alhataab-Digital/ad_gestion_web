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
        Schema::create('signe_vitauxes', function (Blueprint $table) {
            $table->id();
            $table->string('poid');
            $table->string('taille');
            $table->string('numero_ordre');
            $table->string('temperature_corporelle')->nullable();
            $table->string('frequence_cardiaque')->nullable();
            $table->string('frequence_respiratoire')->nullable();
            $table->string('pression_arterielle')->nullable();
            $table->string('saturation_oxygene')->nullable();
            $table->string('douleur')->nullable();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('medecin_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signe_vitauxes');
    }
};
