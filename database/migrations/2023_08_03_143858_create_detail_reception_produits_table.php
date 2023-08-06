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
        Schema::create('detail_reception_produits', function (Blueprint $table) {
            $table->id();
            $table->string('reception_produit_id');
            $table->string('produit_id');
            $table->string('quantite_recu');
            $table->string('prix_unitaire_recu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_reception_produits');
    }
};
