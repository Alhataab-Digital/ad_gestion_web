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
            $table->string('livrer_id');
            $table->string('produit_id');
            $table->string('quantite_livree');
            $table->string('prix_unitaire_livre');
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
