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
        Schema::create('benefice_activites', function (Blueprint $table) {
            $table->id();
            $table->string('montant_investisseur');
            $table->string('taux_repartition');
            $table->string('activite_id');
            $table->date('date_operation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benefice_activites');
    }
};
