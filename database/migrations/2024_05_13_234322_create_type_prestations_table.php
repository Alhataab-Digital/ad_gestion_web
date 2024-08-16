<?php

use App\Models\CabinetMedical\TypePrestation;
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
        Schema::create('type_prestations', function (Blueprint $table) {
            $table->id();
            $table->string('type_prestation');
            $table->string('tarif_prestation');
            $table->timestamps();
        });

        $type_prestations =
            [
                [
                    'Consultation de Médecine Générale',
                    "5000",
                ],
                [
                    'Consultation de Spécialité',
                    "10000",
                ],
            ];
        foreach ($type_prestations as $type_prestation) {
            TypePrestation::create([
                'type_prestation' => $type_prestation[0],
                'tarif_prestation' => $type_prestation[1],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_prestations');
    }
};
