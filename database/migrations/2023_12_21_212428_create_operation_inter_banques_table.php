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
        Schema::create('operation_inter_banques', function (Blueprint $table) {
            $table->id();
            $table->string('montant_operation');
            $table->string('commentaire');
            $table->string('banque_id');
            $table->string('banque_destination_id');
            $table->float('taux');
            $table->string('date_comptable');
            $table->string('date_comptable_reception')->nullable();
            $table->string('user_id');
            $table->string('user_destination_id')->nullable();
            $table->string('etat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_inter_banques');
    }
};
