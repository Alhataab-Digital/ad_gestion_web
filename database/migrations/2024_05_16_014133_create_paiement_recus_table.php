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
        Schema::create('paiement_recus', function (Blueprint $table) {
            $table->id();
            $table->date('date_operation');
            $table->string('montant');
            $table->foreignId('facturation_id')->constrained();
            $table->foreignId('reglement_id')->constrained()->references('id')->on('type_reglements');
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_recus');
    }
};
