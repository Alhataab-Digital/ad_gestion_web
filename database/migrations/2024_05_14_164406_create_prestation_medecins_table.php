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
        Schema::create('prestation_medecins', function (Blueprint $table) {
            $table->id();
            $table->string('type_acte_id');
            $table->foreignId('medecin_id')->constrained();
            $table->foreignId('type_consultation_id')->constrained();
            $table->foreignId('type_prestation_id')->constrained();
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
        Schema::dropIfExists('prestation_medecins');
    }
};
