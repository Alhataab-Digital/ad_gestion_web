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
            $table->string('client_id');
            $table->string('montant');
            $table->string('type_envoi');
            $table->string('frais_envoi');
            $table->string('montant_ttc');
            $table->string('taux_echange')->nullable();
            $table->string('agence_id');
            $table->string('code_envoi');
            $table->string('devise_id');
            $table->string('envoi_user_id');
            $table->date('date_envoi');

            $table->string('region_id');
            $table->string('nom_destinataire');
            $table->string('telephone_destinataire');

            $table->string('type_piece_id')->nullable();
            $table->string('numero_piece')->nullable();
            $table->string('retrait_user_id')->nullable();
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
