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
        Schema::create('operation_reglement_factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facture_id')->constrained();
            $table->foreignId('type_reglement_id')->constrained();
            $table->foreignId('activite_id')->constrained()->references('id')->on('activite_investissements');;
            $table->foreignId('reglement_facture_id')->constrained();
            $table->float('montant_operation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_reglement_factures');
    }
};
