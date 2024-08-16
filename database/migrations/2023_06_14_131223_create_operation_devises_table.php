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
        Schema::create('operation_devises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->foreignId('caisse_id')->constrained();
            $table->integer('reglement_id')->default(0)->references('id')->on('type_reglements');
            $table->integer('client_id')->default(0);
            $table->integer('devise_id')->default(0);
            $table->float('montant_operation');
            $table->string('sens_operation');
            $table->float('taux')->nullable();
            $table->float('coefficient')->nullable();
            $table->float('benefice')->nullable();
            $table->date('date_comptable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operation_devises');
    }
};
