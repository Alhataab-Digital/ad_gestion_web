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
        Schema::create('detenu_models', function (Blueprint $table) {
            $table->id();
            $table->string('civilite');
            $table->string('prenom');
            $table->string('nom');
            $table->string('nom_pere');
            $table->string('nom_mere');
            $table->string('date_naissance');
            $table->string('lieu_naissance');
            $table->string('sexe');
            $table->string('examen_medical');
            $table->string('date_detention');
            $table->string('motif_detention');
            $table->string('photo')->nullable();
            $table->string('date_liberation')->nullable();
            $table->string('date_transfert')->nullable();
            $table->string('mineur')->nullable();
            $table->string('maison_arret_id')->nullable();
            $table->string('utilisateur_id');
            $table->string('etat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detenu_models');
    }
};
