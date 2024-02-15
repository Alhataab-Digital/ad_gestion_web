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
        Schema::create('investisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('heritier');
            $table->float('montant_investis')->default(0);
            $table->float('compte_investisseur')->default(0);
            $table->float('compte_dividende')->default(0);
            $table->char('etat')->default(0);
            $table->foreignId('agence_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->date('date_creation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investisseurs');
    }
};
