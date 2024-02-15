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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->integer('devis_id')->default(0);
            $table->integer('client_id')->default(0);
            $table->integer('entrepot_id')->default(0);
            $table->integer('activite_id')->default(0);
            $table->float('montant_total')->default(0);
            $table->float('montant_regle')->default(0);
            $table->string('etat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
