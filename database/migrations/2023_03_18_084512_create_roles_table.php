<?php

use App\Models\Role;
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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();
        });

        $roles = [
            'Super Administratreur',
            'PDG',
            'Administrateur',
            'DG',
            'Office Manager',
            'Responsable Agence',
            'Gérant',
        ];
        foreach ($roles as $role) {
            Role::create([
                'role' => $role,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
