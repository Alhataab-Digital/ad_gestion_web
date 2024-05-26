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
            $table->float('montant_operation');
            $table->string('sens_operation');
            $table->foreignId('nature_operation_charge_id')->constrained();
            $table->text('commentaire')->nullable();
            $table->string('fichier')->nullable();
            $table->date('date_comptable');
            $table->foreignId('caisse_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->foreignId('agence_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
