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
        Schema::create('hospitalisations', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ordre');
            $table->date('date_adminssion');
            $table->foreignId('type_hospitalisation_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('medecin_id')->constrained();
            $table->string('motif')->nullable();
            $table->foreignId('lit_id')->constrained();
            $table->date('date_sortie');
            $table->foreignId('societe_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitalisations');
    }
};
