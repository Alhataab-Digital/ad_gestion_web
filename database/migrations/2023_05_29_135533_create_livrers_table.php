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
        Schema::create('livrers', function (Blueprint $table) {
            $table->id();
            $table->string('facture_id')->nullable();
            $table->string('client_id')->nullable();
            $table->string('entrepot_id')->nullable();
            $table->string('user_id');
            $table->string('montant_total')->default('0');
            $table->string('agence_id');
            $table->string('etat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livrers');
    }
};
