<?php

use App\Models\CabinetMedical\CategorieMedecin;
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
        Schema::create('categorie_medecins', function (Blueprint $table) {
            $table->id();
            $table->string('categorie_medecin');
            $table->timestamps();
        });

        $categorie_medecins = [
            'Médecin',
            'Chirurgien-dentiste',
            'Pharmacien',
            'Sage-femme',
            'Biologiste médical',
            'Manipulateur d’électroradiologie médicale',
            'Chirurgien',
            'Gynécologue-obstétricien',
            'Cardiologue',
            'Psychiatre',
            'Pédiatre',
            'Dermatologue',
            'Médecin légiste',
            'Nutritionniste',
            'Ophtalmologue',
            'Radiologue',
        ];
        foreach ($categorie_medecins as $categorie_medecin) {
            CategorieMedecin::create([
                'categorie_medecin' => $categorie_medecin,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_medecins');
    }
};
