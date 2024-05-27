<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;
    protected $fillable = [
        'motif',
        'taux_couverture',
        'montant',
        'patient_id',
        'medecin_id',
        'contrat_id',
        'planification_id',
        'date_rdv',
        'heure_rdv',
        'etat',
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

    public function patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function planification()
    {
        return $this->belongsTo(PlanificationMedecin::class,'planification_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class,'medecin_id');
    }

    public function contrat_assurance()
    {
        return $this->belongsTo(ContratAssurance::class,'contrat_id');
    }

}
