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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->float('montant_min');
            $table->float('montant_max');
            $table->float('compte');
            $table->date('date_comptable')->nullable();
            $table->integer('devise_id')->default(0);
            $table->integer('user_id')->default(0)->references('id')->on('utilisateurs');
            $table->char('etat')->default(0);
            $table->foreignId('agence_id')->constrained();
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisses');
    }
};
