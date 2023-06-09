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
            $table->string('type_activite_id');
            $table->string('capital_activite');
            $table->string('montant_decaisse');
            $table->string('total_depense')->nullable();
            $table->string('montant_benefice')->nullable();
            $table->string('commentaire')->nullable();
            $table->string('user_id');
            $table->string('caisse_id');
            $table->string('agence_id');
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
