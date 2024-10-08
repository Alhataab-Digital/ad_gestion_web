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
        Schema::create('facturations', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ordre');
            $table->string('numero_piece');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('medecin_id')->constrained();
            $table->integer('contrat_id')->default(0);
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');
            $table->foreignId('societe_id')->constrained();
            $table->string('taux_assurer')->default(0);
            $table->string('montant');
            $table->string('montant_assurer')->default(0);
            $table->string('montant_patient')->default(0);
            $table->string('montant_paye')->default(0);
            $table->string('reste_a_payer')->default(0);
            $table->string('etat')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturations');
    }
};
