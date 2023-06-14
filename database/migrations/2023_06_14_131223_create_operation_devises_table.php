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
        Schema::create('operation_devises', function (Blueprint $table) {
            $table->id();
            $table->string('montant_operation');
            $table->string('sens_operation');
            $table->string('client_id')->nullable();
            $table->string('devise_id')->nullable();
            $table->string('taux')->nullable();
            $table->string('reglement_id')->nullable();
            $table->string('date_comptable');
            $table->string('caisse_id');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_devises');
    }
};
