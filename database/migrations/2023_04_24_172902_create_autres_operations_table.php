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
        Schema::create('autres_operations', function (Blueprint $table) {
            $table->id();
            $table->float('montant_operation');
            $table->string('sens_operation');
            $table->foreignId('reglement_id')->constrained()->references('id')->on('type_reglements');
            $table->foreignId('caisse_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autres_operations');
    }
};
