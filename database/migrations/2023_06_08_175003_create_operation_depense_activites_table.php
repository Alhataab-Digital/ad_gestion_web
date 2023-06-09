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
        Schema::create('operation_depense_activites', function (Blueprint $table) {
            $table->id();
            $table->string('activite_investissement_id');
            $table->string('secteur_depense_id');
            $table->string('montant_depense');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_depense_activites');
    }
};
