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
        Schema::create('detail_livrers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('livrer_id')->constrained();
            $table->foreignId('produit_id')->constrained();
            $table->integer('quantite_livree');
            $table->float('prix_unitaire_livre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_livrers');
    }
};
