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
        Schema::create('agences', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('adresse')->default('');
            $table->string('telephone')->default('');
            $table->string('email')->default('');
            $table->string('compte_societe')->default('0');
            $table->string('compte_securite')->default('0');
            $table->string('societe_id');
            $table->string('devise_id');
            $table->string('region_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agences');
    }
};
