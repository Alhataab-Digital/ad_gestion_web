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
        Schema::create('banques', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('numero_compte_banque');
            $table->string('compte')->default(0);
            $table->string('user_id');
            $table->string('etat');
            $table->string('agence_id');
            $table->string('societe_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banques');
    }
};
