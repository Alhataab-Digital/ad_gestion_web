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
        Schema::create('mouvement_banques', function (Blueprint $table) {
            $table->id();
            $table->string('banque_id');
            $table->string('user_id');
            $table->string('description');
            $table->string('entree')->nullable();
            $table->string('sortie')->nullable();
            $table->string('solde');
            $table->string('date_comptable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_banques');
    }
};
