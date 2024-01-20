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
        Schema::create('operation_dividendes', function (Blueprint $table) {
            $table->id();
            $table->string('montant_operation');
            $table->string('solde')->default(0);
            $table->string('sens_operation');
            $table->string('reglement_id');
            $table->string('caisse_id');
            $table->string('investisseur_id');
            $table->string('user_id');
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
        Schema::dropIfExists('operation_dividendes');
    }
};
