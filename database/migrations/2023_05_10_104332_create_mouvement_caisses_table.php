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
        Schema::create('mouvement_caisses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('caisse_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->text('description');
            $table->integer('entree')->default(0);
            $table->integer('sortie')->default(0);
            $table->float('solde');
            $table->date('date_comptable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mouvement_caisses');
    }
};
