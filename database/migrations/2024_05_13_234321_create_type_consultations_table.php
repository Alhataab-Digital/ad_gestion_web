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
            $table->text('raison');
            $table->text('contenu');
            $table->timestamps();
        });

        $type_consultations = [

            [
                'Consultation de Médecine Générale',
                " Consultation pour des problèmes de santé courants (rhume, grippe, infections, douleurs musculaires, etc.).",
                " Examen physique, évaluation des symptômes, prescription de médicaments, conseils de prévention, et gestion des maladies chroniques.",
            ],
            [
                'Consultation de Spécialité',
                " Référence à un spécialiste pour des conditions spécifiques (cardiologie, dermatologie, neurologie, etc.).",
                " Examen approfondi lié à la spécialité, tests diagnostiques spécifiques, traitement spécialisé.",
            ],
            [
                'Consultation de Suivi',
                " Suivi après une consultation initiale ou une hospitalisation.",
                " Évaluation de l’évolution de la maladie, ajustement du traitement, suivi des tests de laboratoire ou d’imagerie.",
            ],
            [
                ' Consultation Préventive',
                " Examen de routine pour la prévention et le dépistage des maladies.",
                " Vérification de la pression artérielle, vaccination, dépistage des cancers, conseils sur le mode de vie sain.",
            ],
            [
                "Consultation d'Urgence",
                " Problèmes de santé nécessitant une attention immédiate (blessures, crises aiguës de maladies chroniques, douleurs intenses).",
                " Intervention rapide, premiers soins, stabilisation du patient, et référence éventuelle vers des services d'urgence.",
            ],
            [
                'Consultation de Télémedecine',
                " Consultation à distance via des moyens électroniques pour des raisons pratiques ou en cas de pandémie.",
                " Évaluation des symptômes via vidéo ou téléphone, conseils médicaux, prescriptions électroniques, suivi à distance.",
            ],
            [
                'Consultation pour Santé Mentale',
                " Problèmes psychologiques ou psychiatriques (dépression, anxiété, troubles de l’humeur).",
                " Évaluation psychologique, thérapie, prescription de médicaments psychotropes, référence vers des psychologues ou des psychiatres.",
            ],
            [
                'Consultation Pédiatrique',
                " Soins de santé pour les enfants et les adolescents.",
                " Suivi de croissance, vaccination, traitement des maladies infantiles, conseils aux parents.",
            ],
            [
                'Consultation de Gynécologie et Obstétrique',
                " Suivi de grossesse, problèmes gynécologiques.",
                " Examen gynécologique, suivi prénatal, échographie, conseils sur la contraception et la ménopause.",
            ],
            [
                'Consultation Gériatrique',
                " Soins spécifiques pour les personnes âgées.",
                " Évaluation de la santé globale, gestion des maladies chroniques, prévention des chutes, conseil en matière de soins de longue durée.",
            ],
            [
                'Consultation de Chirurgie',
                " Évaluation pré-opératoire et suivi post-opératoire.",
                " Discussion des options chirurgicales, préparation à la chirurgie, suivi de la récupération, gestion de la douleur post-opératoire.",
            ],

        ];
        foreach ($type_consultations as $type_consultation) {
            TypeConsultation::create([
                'type_consultation' => $type_consultation[0],
                'raison' => $type_consultation[1],
                'contenu' => $type_consultation[2],
            ]);
        }


            //     Consultation Médicale Générale,Visite chez un médecin généraliste pour des problèmes de santé courants.

            //     Consultation Pédiatrique,Consultation pour les enfants avec un pédiatre.

            //     Consultation Gériatrique,Consultation pour les personnes âgées avec un gériatre.

            //     Consultation Préventive,Bilan de santé ou visite de routine pour prévenir les maladies.

            // Consultations Spécialisées

            //     Consultation Cardiologique
            //         Visite chez un cardiologue pour des problèmes cardiaques.

            //     Consultation Dermatologique
            //         Visite chez un dermatologue pour des problèmes de peau.

            //     Consultation Gastro-entérologique
            //         Consultation pour des troubles digestifs avec un gastro-entérologue.

            //     Consultation Neurologique
            //         Visite chez un neurologue pour des problèmes liés au système nerveux.

            //     Consultation Orthopédique
            //         Consultation pour des problèmes osseux et articulaires avec un orthopédiste.

            //     Consultation Gynécologique
            //         Visite chez un gynécologue pour les soins de santé féminins.

            //     Consultation Psychologique/Psychiatrique
            //         Consultation pour des problèmes de santé mentale avec un psychologue ou un psychiatre.

            //     Consultation Oncologique
            //         Consultation pour des problèmes liés au cancer avec un oncologue.

            //     Consultation Ophtalmologique
            //         Visite chez un ophtalmologue pour des problèmes de vue.

            //     Consultation ORL (Oto-Rhino-Laryngologie)
            //         Consultation pour des problèmes liés aux oreilles, nez et gorge.

            // Consultations d'Urgence

            //     Consultation d'Urgence
            //         Visite non programmée en cas de problèmes de santé urgents.

            //     Consultation de Suivi Post-Urgence
            //         Suivi après une visite aux urgences.

            // Consultations pour Maladies Chroniques

            //     Consultation Diabétologique
            //         Suivi pour le diabète avec un spécialiste.

            //     Consultation Rhumatologique
            //         Suivi pour les maladies rhumatismales avec un rhumatologue.

            // Consultations de Spécialités Médicales

            //     Consultation Endocrinologique
            //         Visite chez un endocrinologue pour des troubles hormonaux.

            //     Consultation Néphrologique
            //         Consultation pour des problèmes rénaux avec un néphrologue.

            //     Consultation Pneumologique
            //         Visite chez un pneumologue pour des problèmes pulmonaires.

            // Consultations Chirurgicales

            //     Consultation Pré-opératoire
            //         Évaluation avant une intervention chirurgicale.

            //     Consultation Post-opératoire
            //         Suivi après une intervention chirurgicale.

            // Consultations de Rééducation et Réadaptation

            //     Consultation de Kinésithérapie
            //         Suivi avec un kinésithérapeute pour la rééducation physique.

            //     Consultation Ergothérapeutique
            //         Suivi pour la réadaptation à la vie quotidienne.

            // Consultations à Domicile

            //     Visite Médicale à Domicile
            //         Consultation effectuée au domicile du patient.

            // Consultations Télévisées

            //Téléconsultation
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_consultations');
    }
};
