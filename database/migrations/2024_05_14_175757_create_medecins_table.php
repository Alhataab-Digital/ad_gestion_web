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
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->string('civilite');
            $table->string('nom');
            $table->string('prenom');
            $table->string('situation');
            $table->integer('age');
            $table->string('telephone');
            $table->string('adresse');
            $table->string('taille');
            $table->string('poid');
            $table->string('grade');
            $table->string('mail');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};
