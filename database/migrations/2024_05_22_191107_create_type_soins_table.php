<?php

use App\Models\CabinetMedical\TypeSoins;
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
        Schema::create('type_soins', function (Blueprint $table) {
            $table->id();
            $table->string('type_soins');
            $table->text('description');
            $table->timestamps();
        });

        $type_soins = [

            [
                'Soins Primaires',
                "Les soins primaires sont le premier point de contact pour les patients. Ils incluent la prévention, le diagnostic et le traitement des maladies courantes et la gestion des problèmes de santé chroniques.",
            ],
            [
                'Soins Spécialisés',
                "Les soins spécialisés sont fournis par des médecins spécialistes qui ont une expertise dans un domaine médical spécifique.",
            ],
            [
                "Soins d'Urgence",
                "Les soins d'urgence sont fournis pour les conditions médicales qui nécessitent une attention immédiate pour éviter des conséquences graves.",
            ],
            [
                'Soins Intensifs',
                "Les soins intensifs sont dispensés aux patients souffrant de maladies ou de blessures potentiellement mortelles nécessitant une surveillance et un traitement continus.",
            ],
            [
                'Soins Chirurgicaux',
                "Les soins chirurgicaux impliquent des interventions médicales invasives pour traiter ou corriger des conditions médicales.",
            ],
            [
                'Soins de Réhabilitation',
                "Les soins de réhabilitation visent à aider les patients à retrouver leurs capacités après une maladie ou une blessure.",
            ],
            [
                'Soins Palliatifs',
                "Les soins palliatifs sont destinés à améliorer la qualité de vie des patients atteints de maladies graves en soulageant la douleur et les symptômes.",
            ],
            [
                'Soins de Santé Mentale',
                "Les soins de santé mentale comprennent le diagnostic et le traitement des troubles mentaux et émotionnels.",
            ],
            [
                'Soins Préventifs',
                "Les soins préventifs visent à prévenir les maladies et à promouvoir la santé par des actions proactives.",
            ],
            [
                "Soins Dentaires",
                "Les soins dentaires concernent la santé des dents et des gencives, incluant la prévention, le diagnostic et le traitement des maladies bucco-dentaires.",
            ],
            [
                'Soins de Maternité',
                "Les soins de maternité incluent les soins avant, pendant et après la grossesse et l'accouchement.",
            ],
            [
                'Test de tolérance au glucose',
                " Mesure de la capacité du corps à gérer le glucose, utilisé pour diagnostiquer le diabète et l'intolérance au glucose.",
            ],
            [
                'Densitométrie osseuse (DEXA)',
                "Mesure de la densité minérale osseuse pour évaluer le risque d'ostéoporose et de fractures.",
            ],
            [
                'Spirométrie ',
                "Test de la fonction pulmonaire qui mesure le volume et la vitesse de l'air expiré. Utilisé pour diagnostiquer des maladies respiratoires comme l'asthme et la MPOC.",
            ],
            [
                'Électroencéphalogramme (EEG) :',
                "Enregistrement de l'activité électrique du cerveau. Utilisé pour diagnostiquer des conditions neurologiques comme l'épilepsie et les troubles du sommeil.",
            ],
        ];

        foreach ($type_soins as $type_soin) {
            TypeSoins::create([
                'type_soins' => $type_soin[0],
                'description' => $type_soin[1],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_soins');
    }
};
