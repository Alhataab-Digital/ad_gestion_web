<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifMedical extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle_tarif',
        'prix',
        'user_id',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
