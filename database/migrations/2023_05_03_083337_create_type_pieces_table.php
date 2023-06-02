<?php
use App\Models\TypePiece;
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
        Schema::create('type_pieces', function (Blueprint $table) {
            $table->id();
            $table->string('type_piece');
            $table->timestamps();
        });

        $pieces=['CARTE IDENTITE NATIONAL','PASSPORT','PERMIS DE CONDUIRE','AUTRES'];
        foreach($pieces as $piece){
            TypePiece::create([
                'type_piece'=>$piece,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_pieces');
    }
};
