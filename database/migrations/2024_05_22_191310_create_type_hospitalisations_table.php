<?php

use App\Models\CabinetMedical\TypeHospitalisation;
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
        Schema::create('type_hospitalisations', function (Blueprint $table) {
            $table->id();
            $table->string('type_hospitalisation');
            $table->double('tarif_hospitalisation');
            $table->timestamps();
        });
        $type_hospitalisations = [

            [
                'Urgence',
                "0",
            ],

        ];

        foreach ($type_hospitalisations as $type_hospitalisation) {
            TypeHospitalisation::create([
                'type_hospitalisation' => $type_hospitalisation[0],
                'tarif_hospitalisation' => $type_hospitalisation[1],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_hospitalisations');
    }
};
