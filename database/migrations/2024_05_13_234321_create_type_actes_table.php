<?php

use App\Models\CabinetMedical\TypeActe;
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
        Schema::create('type_actes', function (Blueprint $table) {
            $table->id();
            $table->string('type_acte');
            $table->timestamps();
        });
        $type_actes =
            [
                'Consultations',
                'Actes de prévention',
                'Soins courants',
                'Examens complémentaires',
                "Suivis de maladies chroniques",
                'Actes techniques spécifiques',
                'Conseils et orientation ',
            ];
        foreach ($type_actes as $type_acte) {
            TypeActe::create([
                'type_acte' => $type_acte,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_actes');
    }
};
