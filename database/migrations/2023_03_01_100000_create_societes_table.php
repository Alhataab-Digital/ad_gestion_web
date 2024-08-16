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
        Schema::create('societes', function (Blueprint $table) {
            $table->id();
            $table->string('raison_sociale');
            $table->string('activite');
            $table->string('forme_juridique');
            $table->string('telephone');
            $table->string('email')->nullable();
            $table->string('code_postal')->nullable();
            $table->string('adresse')->nullable();
            $table->string('complement')->nullable();
            $table->string('site_web')->nullable();
            $table->string('logo')->nullable();
            $table->float('compte_societe')->default(0);
            $table->float('compte_securite')->default(0);
            $table->foreignId('region_id')->constrained();
            $table->foreignId('admin_id')->constrained()->references('id')->on('utilisateurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('societes');
    }
};
