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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('civilite_id')->nullable()->constrained();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('profession')->nullable();
            $table->foreignId('situation_matrimoniale_id')->nullable()->constrained();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('telephone');
            $table->string('adresse')->nullable();
            $table->string('complement_adresse')->nullable();
            $table->string('personne_contact')->nullable();
            $table->string('mail')->nullable();

            $table->string('numero_patient');
            $table->string('poid')->nullable();
            $table->string('taille')->nullable();
            $table->string('temperature')->nullable();
            $table->string('groupe_sanguin')->nullable();
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
        Schema::dropIfExists('patients');
    }
};
