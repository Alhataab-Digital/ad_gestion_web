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
        Schema::create('activite_investissements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('caisse_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->foreignId('type_activite_id')->constrained();
            $table->float('capital_activite');
            $table->float('montant_decaisse');
            $table->float('total_depense')->default(0);
            $table->float('total_recette')->default(0);
            $table->float('compte_activite')->default(0);
            $table->float('montant_benefice')->default(0);
            $table->float('taux_devise');
            $table->text('commentaire')->nullable();
            $table->string('etat_activite')->default('en cours');
            $table->date('date_comptable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activite_investissements');
    }
};
