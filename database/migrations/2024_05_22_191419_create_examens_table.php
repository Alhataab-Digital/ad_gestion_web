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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ordre');
            $table->string('analyse_id');
            $table->text('resultat')->nullable();
            $table->foreignId('type_examen_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('medecin_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });


}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
