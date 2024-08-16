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
        Schema::create('maison_assurances', function (Blueprint $table) {
            $table->id();
            $table->string('maison_assurance');
            $table->string('telephone');
            $table->string('adresse');
            $table->string('mail');
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maison_assurances');
    }
};
