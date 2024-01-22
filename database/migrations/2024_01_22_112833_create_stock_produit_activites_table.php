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
        Schema::create('stock_produit_activites', function (Blueprint $table) {
            $table->id();
            $table->string('produit_id');
            $table->string('activite_id');
            $table->string('quantite_en_stock');
            $table->string('agence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_produit_activites');
    }
};
