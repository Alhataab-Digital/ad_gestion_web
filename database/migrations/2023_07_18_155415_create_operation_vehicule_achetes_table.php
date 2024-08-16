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
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->foreignId('fournisseur_id')->constrained();
            $table->foreignId('activite_id')->constrained()->references('id')->on('activite_investissements');
            $table->foreignId('caisse_id')->constrained();
            $table->string('annee');
            $table->string('marque');
            $table->string('model');
            $table->string('chassis');
            $table->float('prix_achat');
            $table->float('charge_usa');
            $table->float('prix_revient');
            $table->date('date_comptable');
            $table->string('sens_operation');
            $table->string('etat')->nullable();
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
