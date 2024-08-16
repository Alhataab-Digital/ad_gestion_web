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
            $table->foreignId('specialite_id')->constrained()->references('id')->on('specialite_medecins');
            $table->foreignId('medecin_id')->constrained();
            $table->foreignId('type_consultation_id')->constrained();
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
        Schema::dropIfExists('planification_medecins');
    }
};
