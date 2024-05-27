<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'medecin_id',
        'diagnostique',
        'traitement',
        'rdv_id',
        'tarif_consultation_id',
        'user_id',
        'societe_id',
        'etat',
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

    public function rendez_vous()
    {
        return $this->belongsTo(Rdv::class,'rdv_id');
    }

    public function tarif_consultation()
    {
        return $this->belongsTo(TarifConsultation::class,'tarif_consultation_id');
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }
}
