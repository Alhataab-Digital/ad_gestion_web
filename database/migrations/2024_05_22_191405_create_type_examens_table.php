<?php

use App\Models\CabinetMedical\TypeExamen;
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
        Schema::create('type_examens', function (Blueprint $table) {
            $table->id();
            $table->string('type_examen');
            $table->text('description');
            $table->timestamps();
        });

        $type_examens = [

            [
                'Examen physique',
                "Évaluation générale de la santé du patient par un médecin, y compris la vérification des signes vitaux (pression artérielle, fréquence cardiaque, température, respiration) et l'examen des différentes parties du corps.",
            ],
            [
                'Analyses de sang',
                "Tests de laboratoire effectués sur un échantillon de sang pour évaluer divers paramètres, tels que la numération globulaire, les niveaux de glucose, les lipides, les enzymes hépatiques, les électrolytes, et les marqueurs de maladies spécifiques.",
            ],
            [
                'Radiographie (Rayons X)',
                "Utilisation de rayons X pour créer des images des structures internes du corps, principalement des os. Utilisé pour diagnostiquer les fractures, les infections, et d'autres conditions osseuses.",
            ],
            [
                'Échographie (Ultrasonographie)',
                "Utilisation d'ondes sonores à haute fréquence pour créer des images des organes internes et des tissus mous. Souvent utilisé pour surveiller la grossesse, évaluer les organes abdominaux, et examiner les glandes thyroïdiennes.",
            ],
            [
                'IRM (Imagerie par Résonance Magnétique)',
                " Utilisation de champs magnétiques et d'ondes radio pour produire des images détaillées des organes et des tissus internes. Utilisé pour diagnostiquer des affections cérébrales, des tumeurs, et des anomalies musculaires et articulaires.",
            ],
            [
                'CT Scan (Tomodensitométrie)',
                "Utilisation de rayons X pour créer des images en coupe transversale du corps. Utile pour diagnostiquer des tumeurs, des lésions internes, et des maladies vasculaires.",
            ],
            [
                'ECG (Électrocardiogramme)',
                "Enregistrement de l'activité électrique du cœur pour détecter des anomalies du rythme cardiaque, des infarctus du myocarde, et d'autres problèmes cardiaques.",
            ],
            [
                'Endoscopie',
                " Utilisation d'un endoscope (un tube flexible avec une caméra) pour visualiser l'intérieur du tractus gastro-intestinal. Utilisé pour diagnostiquer et traiter des affections comme les ulcères, les polypes, et les cancers.",
            ],
            [
                'Mammographie',
                "Utilisation de rayons X pour examiner les seins. Principalement utilisé pour dépister et diagnostiquer le cancer du sein.",
            ],
            [
                "Analyse d'urine",
                " Examen de l'urine pour détecter des substances anormales, telles que le glucose, les protéines, les cellules sanguines, et les bactéries. Utilisé pour diagnostiquer les infections des voies urinaires, les maladies rénales, et d'autres affections métaboliques.",
            ],
            [
                'Biopsie',
                "Prélèvement d'un petit échantillon de tissu pour une analyse au microscope. Utilisé pour diagnostiquer les cancers et autres maladies tissulaires.",
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

        foreach ($type_examens as $type_examen) {
            TypeExamen::create([
                'type_examen' => $type_examen[0],
                'description' => $type_examen[1],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_examens');
    }
};
