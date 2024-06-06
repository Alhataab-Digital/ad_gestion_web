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
        'specialite_id',
        'tarif_consultation_id',
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

    public function tarif_consultation()
    {
        return $this->belongsTo(TarifConsultation::class,'tarif_consultation_id');
    }

    public function specialite()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class,'medecin_id');
    }
}
