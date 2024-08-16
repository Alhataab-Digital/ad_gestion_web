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
        Schema::create('detail_activite_investissements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activite_id')->constrained()->references('id')->on('activite_investissements');
            $table->foreignId('investisseur_id')->constrained();
            $table->float('montant_investis');
            $table->float('taux')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_activite_investissements');
    }
};
