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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->string('civilite')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('situation')->nullable();
            $table->integer('age')->nullable();
            $table->string('telephone');
            $table->string('adresse')->nullable();
            $table->string('taille')->nullable();
            $table->string('poid')->nullable();
            $table->string('mail')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
