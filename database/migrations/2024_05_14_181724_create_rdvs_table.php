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
        Schema::create('rdvs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->foreignId('patient_id')->nullable()->constrained();
            $table->foreignId('medecin_id')->nullable()->constrained();
            $table->foreignId('contrat_id')->default(0)->constrained();
            $table->foreignId('planification_id')->nullable()->constrained();
            $table->date('date_rdv');
            $table->time('heure_rdv')->nullable();
            $table->string('etat')->default(0);
            $table->string('motif')->nullable();
            $table->float('taux_couverture')->default(0);
            $table->float('montant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdvs');
    }
};
