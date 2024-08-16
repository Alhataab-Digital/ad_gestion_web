<?php

use App\Models\CabinetMedical\TypeConsultation;
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
        Schema::create('type_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('type_consultation');
            $table->double('tarif_consultation');
            $table->timestamps();
        });

        $type_consultations = [

            [
                'Consultation de Médecine Générale',
                "5000",
            ],
            [
                'Consultation de Spécialité',
                "10000",
            ],

            [
                'Consultation Pédiatrique',
                "2500",
             ],
            [
                'Consultation de Gynécologie et Obstétrique',
                "3000",
            ],

            [
                'Consultation de Chirurgie',
                "50000",
            ],
        ];
        foreach ($type_consultations as $type_consultation) {
            TypeConsultation::create([
                'type_consultation' => $type_consultation[0],
                'tarif_consultation' => $type_consultation[1],
            ]);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_consultations');
    }
};
