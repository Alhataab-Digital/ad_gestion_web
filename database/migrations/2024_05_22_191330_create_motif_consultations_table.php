<?php

use App\Models\CabinetMedical\MotifConsultation;
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
        Schema::create('motif_consultations', function (Blueprint $table) {
            $table->id();
            $table->string('motif');
            $table->timestamps();
        });

        $motifs = [
        "Fièvre",
        "Douleur abdominale",
        "Maux de tête",
        "Symptômes respiratoires (toux, essoufflement)",
        "Douleur thoracique",
        "Fatigue générale",
        "Problèmes de peau (éruptions cutanées, démangeaisons)",
        "Vertiges ou étourdissements",
        "Problèmes urinaires (douleur en urinant, changements dans la fréquence urinaire)",
        "Douleurs articulaires ou musculaires",
        "Symptômes gastro-intestinaux (nausées, vomissements, diarrhée)",
        "Troubles du sommeil",
        "Symptômes neurologiques (engourdissement, faiblesse, changements de vision)",
        "Problèmes de santé mentale (anxiété, dépression)",
        "Blessures ou traumatismes",
        "Symptômes gynécologiques (douleur pelvienne, irrégularités menstruelles)",
        "Symptômes urologiques (problèmes de prostate, douleur testiculaire)",
        "Problèmes de poids ou de nutrition",
        "Symptômes oculaires (rougeur, vision floue)",
        "Problèmes de santé sexuelle (dysfonction érectile, infections sexuellement transmissibles)",
        ];
        foreach ($motifs as $motif) {
            MotifConsultation::create([
                'motif' => $motif,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motif_consultations');
    }
};
