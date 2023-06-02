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
        Schema::create('repartition_dividendes', function (Blueprint $table) {
            $table->id();
            $table->string('investisseur_id');
            $table->string('activite_id');
            $table->string('montant_investis');
            $table->string('dividende_gagner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repartition_dividendes');
    }
};
