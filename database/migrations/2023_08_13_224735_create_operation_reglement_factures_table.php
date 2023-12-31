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
            $table->string('facture_id');
            $table->string('type_reglement_id');
            $table->string('activite_id');
            $table->string('montant_operation');
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
