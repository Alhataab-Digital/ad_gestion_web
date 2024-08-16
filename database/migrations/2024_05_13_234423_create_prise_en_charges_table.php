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
        Schema::create('prise_en_charges', function (Blueprint $table) {
            $table->id();
            $table->string('numero_assurer');
            $table->string('confirm_assurer');
            $table->string('nom_assurer')->nullable();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('contrat_assurance_id')->constrained();
            $table->foreignId('maison_assurance_id')->constrained();
            $table->foreignId('user_id')->constrained()->references('id')->on('utilisateurs');;
            $table->foreignId('societe_id')->constrained();
            $table->timestamps();
        });

        // ID INT AUTO_INCREMENT PRIMARY KEY,
        // ContratID INT,
        // DatePriseEnCharge DATE NOT NULL,
        // Montant DECIMAL(10, 2) NOT NULL,
        // Description TEXT,
        // FOREIGN KEY (ContratID) REFERENCES Contrat(ID)

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prise_en_charges');
    }
};
