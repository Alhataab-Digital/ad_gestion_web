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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom_produit');
            $table->string('description_produit');
            $table->string('prix_unitaire_achat');
            $table->string('prix_unitaire_revient')->nullable();
            $table->string('prix_unitaire_vente');
            $table->string('stock_min');
            $table->string('categorie_produit_id');
            $table->string('agence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
