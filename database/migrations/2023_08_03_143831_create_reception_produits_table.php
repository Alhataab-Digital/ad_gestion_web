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
        Schema::create('reception_produits', function (Blueprint $table) {
            $table->id();
            $table->string('commande_id')->nullable();
            $table->string('fournisseur_id')->nullable();
            $table->string('entrepot_id')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->float('montant_total')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reception_produits');
    }
};
