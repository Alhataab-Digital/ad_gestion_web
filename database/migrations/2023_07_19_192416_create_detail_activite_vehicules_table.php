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
        Schema::create('detail_activite_vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('activite_vehicule_id');
            $table->string('investisseur_id');
            $table->string('montant_investis');
            $table->string('taux')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_activite_vehicules');
    }
};
