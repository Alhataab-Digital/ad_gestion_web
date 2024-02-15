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
        Schema::create('reglement_factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facture_id')->constrained();
            $table->float('montant_regle')->default(0);
            $table->float('montant_non_regle')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reglement_factures');
    }
};
