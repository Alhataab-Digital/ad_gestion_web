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
        Schema::create('agence_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agence_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agence_users');
    }
};
