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
            $table->foreignId('categorie_produit_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->string('nom_produit');
            $table->text('description_produit');
            $table->float('prix_unitaire_achat');
            $table->float('prix_unitaire_revient')->default(0);
            $table->float('prix_unitaire_vente');
            $table->integer('stock_min');
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
