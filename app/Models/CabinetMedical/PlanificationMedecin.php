<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificationMedecin extends Model
{
    use HasFactory;
    protected $fillable = [
        'tarif_medical_id',
        'jour_semaine',
        'heure_debut',
        'heure_fin',
        'medecin_id',
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

    public function tarif()
    {
        return $this->belongsTo(TarifMedical::class,'tarif_medical_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}
