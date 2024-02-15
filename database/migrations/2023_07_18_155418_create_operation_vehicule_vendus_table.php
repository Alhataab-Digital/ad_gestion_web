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
        Schema::create('operation_vehicule_vendus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('caisse_id')->constrained();
            $table->foreignId('activite_id')->constrained();
            $table->foreignId('operation_vehicule_achete_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->float('prix_vente')->nullable();
            $table->float('marge')->nullable();
            $table->float('taux_devise')->nullable();
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
        Schema::dropIfExists('operation_vehicule_vendus');
    }
};
