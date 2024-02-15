<?php

use App\Models\TypeReglement;
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
        Schema::create('type_reglements', function (Blueprint $table) {
            $table->id();
            $table->string('reglement');
            $table->timestamps();
        });

        $reglements = [
            'Espece',
            'Cheque',
            'Virement',
            'Carte',
        ];

        foreach ($reglements as $reglement) {
            TypeReglement::create([
                'reglement' => $reglement,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_reglements');
    }
};
