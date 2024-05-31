<?php

use App\Models\CabinetMedical\Medicament;
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
        Schema::create('medicaments', function (Blueprint $table) {
            $table->id();
            $table->string('denomination');
            $table->string('forme_pharmaceutique');
            $table->string('voies_administrative');
            $table->timestamps();
        });
        $medicaments = [

            [
                'Paracétamol',
                'Comprimé',
                "Voie orale",
            ],
            [
                'Ibuprofène',
                'Gélule',
                "Voie orale",
            ],
            [
                'Amoxicilline',
                'Suspension buvable',
                "Voie orale",
            ],
            [
                'Loratadine',
                'Comprimé',
                "Voie orale",
            ],
            [
                'Salbutamol',
                'Aérosol-doseur',
                "Inhalation",
            ],
            [
                'Morphine',
                'Solution injectable',
                "Voie injectable",
            ],
            [
                'Acide acétylsalicylique (Aspirine)',
                'Comprimé effervescent',
                "Voie orale",
            ],
            [
                'Insuline',
                'Stylo prérempli',
                "Injection sous-cutanée",
            ],
            [
                'Diazépam',
                'Solution rectale',
                "Voie rectale",
            ],
            [
                'Nitroglycérine',
                'Patch transdermique',
                "Voie transdermique",
            ],
            [
                'Oxygène',
                'Gaz comprimé',
                "Inhalation",
            ],
        ];

        foreach ($medicaments as $medicament) {
            Medicament::create([
                'denomination' => $medicament[0],
                'forme_pharmaceutique' => $medicament[1],
                'voies_administrative' => $medicament[2],
            ]);
        }
    }
//           Paracétamol

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicaments');
    }
};
