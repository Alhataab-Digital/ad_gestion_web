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
            $table->foreignId('activite_id')->constrained()->references('id')->on('activite_investissements');
            $table->foreignId('secteur_depense_id')->constrained();
            $table->float('montant_depense');
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
