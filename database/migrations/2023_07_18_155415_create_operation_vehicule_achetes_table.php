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
        Schema::create('operation_vehicule_achetes', function (Blueprint $table) {
            $table->id();
            $table->string('annee');
            $table->string('marque');
            $table->string('model');
            $table->string('chassis');
            $table->string('prix_achat');
            $table->string('charge_usa');
            $table->string('prix_revient');
            $table->string('fournisseur_id');
            $table->string('date_comptable');
            $table->string('sens_operation');
            $table->string('etat')->nullable();
            $table->string('activite_id');
            $table->string('caisse_id');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_vehicule_achetes');
    }
};
