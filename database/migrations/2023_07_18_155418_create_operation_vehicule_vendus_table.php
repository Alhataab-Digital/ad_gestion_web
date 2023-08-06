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
            $table->string('prix_vente')->nullable();
            $table->string('marge')->nullable();
            $table->string('client_id');
            $table->string('date_comptable');
            $table->string('sens_operation');
            $table->string('etat')->nullable();
            $table->string('activite_id');
            $table->string('operation_vehicule_achete_id');
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
        Schema::dropIfExists('operation_vehicule_vendus');
    }
};
