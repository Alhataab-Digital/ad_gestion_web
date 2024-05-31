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
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('civilite_id')->constrained();
            $table->string('nom');
            $table->string('prenom');
            $table->foreignId('situation_matrimoniale_id')->constrained();
            $table->date('date_naissance');
            $table->string('lieu_naissance');

            $table->string('titre');
            $table->string('telephone');
            $table->string('adresse');
            $table->string('mail');

            $table->string('matricule');
            $table->foreignId('specialite_id')->constrained();
            $table->foreignId('categorie_medicale_id')->constrained();
            $table->foreignId('espace_id')->nullable()->constrained();

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
        Schema::dropIfExists('medecins');
    }
};
