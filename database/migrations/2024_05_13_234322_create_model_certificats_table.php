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
        Schema::create('model_certificats', function (Blueprint $table) {
            $table->id();
            $table->string('model_certificat');
            $table->foreignId('type_model_id')->constrained();
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
        Schema::dropIfExists('model_certificats');
    }
};
