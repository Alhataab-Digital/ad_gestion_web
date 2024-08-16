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
        Schema::create('operation_investisseurs', function (Blueprint $table) {
            $table->id();
            $table->float('montant_operation');
            $table->float('solde')->default(0);
            $table->string('sens_operation');
            $table->foreignId('reglement_id')->constrained()->references('id')->on('type_reglements');
            $table->foreignId('caisse_id')->constrained();
            $table->foreignId('investisseur_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->string('valider')->default("non");
            $table->date('date_comptable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_investisseurs');
    }
};
