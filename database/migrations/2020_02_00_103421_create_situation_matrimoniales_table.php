<?php

use App\Models\SituationMatrimoniale;
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
        Schema::create('situation_matrimoniales', function (Blueprint $table) {
            $table->id();
            $table->string('situation_matrimoniale');
            $table->timestamps();
        });
        $situation_matrimoniales = [
            "Celibataire",
            "Marié(e)",
            "Veuf(ve)",
            "Divorcé(e)",
        ];
        foreach ($situation_matrimoniales as $situation_matrimoniale) {
            SituationMatrimoniale::create([
                'situation_matrimoniale' => $situation_matrimoniale,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situation_matrimoniales');
    }
};
