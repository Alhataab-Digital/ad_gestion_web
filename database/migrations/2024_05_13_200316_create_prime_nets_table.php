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
        Schema::create('prime_nets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usage_id')->constrained();
            $table->foreignId('puissance_id')->constrained();
            $table->foreignId('energie_id')->constrained();
            $table->foreignId('zone_id')->constrained();
            $table->foreignId('groupe_id')->constrained();
            $table->foreignId('classe_id')->constrained();
            $table->string('montant');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prime_nets');
    }
};
