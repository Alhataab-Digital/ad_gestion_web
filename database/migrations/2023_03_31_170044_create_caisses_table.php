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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('montant_min');
            $table->string('montant_max');
            $table->string('compte')->default('0');
            $table->date('date_comptable')->nullable();
            $table->string('devise_id')->default('0');
            $table->string('user_id')->default('0');
            $table->string('etat')->default('0');
            $table->string('agence_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisses');
    }
};
