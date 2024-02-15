<?php

use App\Models\TypeGestion;
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
        Schema::create('type_gestions', function (Blueprint $table) {
            $table->id();
            $table->string('gestion');
            $table->timestamps();
        });

        $type_gestions = [
            'Echange d\'argent',
            'Stock',
            'Magasin',
            'Scolaire',
            'Parc Informatique',
            'Parc Auto',
            'Hotel',
            'Cabinet Assurance',
            'Cabinet Medical',
            'Couture',
            'Investissement',
            'Gestion Detenu',
        ];
        foreach ($type_gestions as $type_gestion) {
            TypeGestion::create([
                'gestion' => $type_gestion,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_gestions');
    }
};
