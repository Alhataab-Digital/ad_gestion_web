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
        Schema::create('operation_inter_banques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->foreignId('banque_id')->constrained();
            $table->foreignId('banque_destination_id')->constrained()->references('id')->on('banques');
            $table->integer('user_destination_id')->default(0)->references('id')->on('utilisateurs');;
            $table->float('montant_operation');
            $table->text('commentaire');
            $table->float('taux');
            $table->date('date_comptable');
            $table->date('date_comptable_reception')->nullable();
            $table->string('etat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_inter_banques');
    }
};
