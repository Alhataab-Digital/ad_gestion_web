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
            $table->string('intitule');
            $table->string('capital_activite');
            $table->string('montant_ouverture');
            $table->string('montant_vente')->nullable();
            $table->string('total_depense')->nullable();
            $table->string('montant_benefice')->nullable();
            $table->string('taux_devise');
            $table->string('detail')->nullable();
            $table->string('user_id');
            $table->string('caisse_id');
            $table->string('agence_id');
            $table->string('societe_id');
            $table->string('etat_activite')->nullable();;
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
