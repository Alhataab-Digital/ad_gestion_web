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
        Schema::create('detail_factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facture_id')->constrained();
            $table->foreignId('produit_id')->constrained();
            $table->integer('quantite_vendue');
            $table->float('prix_unitaire_vendu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_factures');
    }
};
