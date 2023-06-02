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
        Schema::create('detail_devis', function (Blueprint $table) {
            $table->id();
            $table->string('devis_id');
            $table->string('produit_id');
            $table->string('quantite_demandee');
            $table->string('prix_unitaire_demande');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_devis');
    }
};
