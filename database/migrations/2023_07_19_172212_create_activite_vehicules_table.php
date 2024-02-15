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
        Schema::create('activite_vehicules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('caisse_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->string('intitule');
            $table->float('capital_activite');
            $table->float('montant_ouverture');
            $table->float('montant_vente')->nullable();
            $table->float('total_depense')->nullable();
            $table->float('montant_benefice')->nullable();
            $table->float('taux_devise');
            $table->text('detail')->nullable();
            $table->string('etat_activite')->nullable();
            $table->date('date_comptable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_vehicules');
    }
};
