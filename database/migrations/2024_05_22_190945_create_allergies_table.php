<?php

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
        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

//Allergies alimentaires : Réactions à certains aliments comme les arachides, les noix, les fruits de mer, le lait, les œufs, le blé, et le soja. Les symptômes peuvent inclure des éruptions cutanées, des gonflements, des troubles gastro-intestinaux, et dans les cas graves, une anaphylaxie.

// Allergies respiratoires : Provoquées par des allergènes inhalés tels que le pollen (rhume des foins), les acariens, les moisissures, et les poils d'animaux. Les symptômes peuvent inclure des éternuements, une congestion nasale, des démangeaisons dans la gorge, et des crises d'asthme.

// Allergies cutanées : Comprennent des réactions comme l'eczéma, l'urticaire, et la dermatite de contact. Ces allergies sont souvent provoquées par le contact direct avec des allergènes comme le latex, certains métaux (comme le nickel), ou des produits chimiques présents dans les cosmétiques et les produits de nettoyage.

// Allergies médicamenteuses : Réactions indésirables à certains médicaments, tels que les antibiotiques (pénicilline), les anti-inflammatoires non stéroïdiens (AINS), et les anesthésiques. Les symptômes peuvent varier de légers (éruptions cutanées) à graves (anaphylaxie).

// Allergies aux piqûres d’insectes : Réactions aux venins d'insectes comme les abeilles, les guêpes, les moustiques, et les fourmis. Les réactions peuvent aller de légères (rougeur et gonflement localisés) à graves (anaphylaxie).

// Allergies aux substances chimiques : Réactions à des produits chimiques présents dans l'environnement, y compris les produits de nettoyage, les parfums, et les solvants. Ces allergies peuvent provoquer des symptômes respiratoires, cutanés, ou des maux de t


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergies');
    }
};
