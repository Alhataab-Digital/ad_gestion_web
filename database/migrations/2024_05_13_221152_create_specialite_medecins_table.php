<?php

use App\Models\CabinetMedical\SpecialiteMedecin;
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
        Schema::create('specialite_medecins', function (Blueprint $table) {
            $table->id();
            $table->string('specialite_medecin');
            $table->text('description');
            $table->timestamps();
        });

        $specialite_medecins = [
            [ 'Cardiologie'," Étude et traitement des maladies du cœur et du système cardiovasculaire."],
            ['Dermatologie',"Diagnostic et traitement des maladies de la peau, des cheveux et des ongles."],
            ['Endocrinologie'," Gestion des troubles hormonaux et des maladies du système endocrinien."],
            ['Gastro-entérologie',"Traitement des maladies du système digestif."],
            ['Gynécologie et obstétrique', "Soins de santé des femmes, y compris la grossesse et l'accouchement."],
            ['Hématologie', "Étude et traitement des maladies du sang."],
            ['Neurologie', "Diagnostic et traitement des troubles du système nerveux."],
            ['Oncologie', "Traitement du cancer."],
            ['Ophtalmologie',"Soins des yeux et traitement des maladies oculaires."],
            ['Orthopédie',"Soins des maladies et des blessures du système musculo-squelettique."],
            ['Oto-rhino-laryngologie (ORL)', "Traitement des maladies des oreilles, du nez et de la gorge."],
            ['Pédiatrie',"Soins de santé des enfants, des nourrissons et des adolescents."],
            ['Psychiatrie',"Diagnostic et traitement des maladies mentales et des troubles psychiatriques."],
            ['Pneumologie',"Soins des maladies des poumons et du système respiratoire."],
            ['Rhumatologie',"Traitement des maladies des articulations, des muscles et des os"],
            ['Urologie' ,"Traitement des maladies du système urinaire et reproducteur masculin."],
            ['Médecine générale' , "Soins de santé primaires couvrant un large éventail de conditions et de maladies."]

        ];
        foreach ($specialite_medecins as $specialite_medecin) {
          
            SpecialiteMedecin::create([
                'specialite_medecin' => $specialite_medecin[0],
                'description' => $specialite_medecin[1],
            ]);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialite_medecins');
    }
};
