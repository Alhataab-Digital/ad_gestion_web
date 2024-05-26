<?php

use App\Models\Civilite;
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
        Schema::create('civilites', function (Blueprint $table) {
            $table->id();
            $table->string('civilite');
            $table->timestamps();
        });
        $civilites = [
            'Mr',
            'Mme',
            'Mlle',
        ];
        foreach ($civilites as $civilite) {
            Civilite::create([
                'civilite' => $civilite,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('civilites');
    }
};
