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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->string('montant_operation');
            $table->string('sens_operation');
            $table->string('nature_operation_charge_id');
            $table->string('commentaire')->nullable();
            $table->string('fichier')->nullable();
            $table->string('date_comptable');
            $table->string('caisse_id');
            $table->string('agence_id');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
