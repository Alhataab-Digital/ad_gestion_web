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
        Schema::create('operation_banques', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->string('banque_id');
            $table->string('description');
            $table->string('montant_operation');
            $table->string('sens_operation');
            $table->string('piece')->nullable();
            $table->string('date_comptable');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_banques');
    }
};
