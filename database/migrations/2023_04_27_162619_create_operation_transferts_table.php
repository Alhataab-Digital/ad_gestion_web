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
        Schema::create('operation_transferts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->float('montant');
            $table->string('type_envoi');
            $table->float('frais_envoi');
            $table->float('montant_ttc');
            $table->float('taux_echange')->default(0);
            $table->foreignId('agence_id')->constrained();
            $table->string('code_envoi');
            $table->foreignId('devise_id')->constrained();
            $table->foreignId('envoi_user_id')->constrained()->references('id')->on('utilisateurs');
            $table->date('date_envoi');

            $table->foreignId('region_id')->constrained();
            $table->string('nom_destinataire');
            $table->string('telephone_destinataire');

            $table->integer('type_piece_id')->default(0);
            $table->string('numero_piece')->nullable();
            $table->integer('retrait_user_id')->default(0)->references('id')->on('utilisateurs');
            $table->date('date_retrait')->nullable();

            $table->string('etat')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_transferts');
    }
};
