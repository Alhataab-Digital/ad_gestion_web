<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facturation extends Model
{
    use HasFactory;
    protected $fillable = [
        'rdv_id',
        'patient_id',
        'medecin_id',
        'tarif_consultation_id',
        'taux_assurer',
        'montant',
        'montant_assurer',
        'montant_patient',
        'montant_paye',
        'reste_a_payer',
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

    public function tarif_consultation()
    {
        return $this->belongsTo(TarifConsultation::class);
    }
    public function rendez_vous()
    {
        return $this->belongsTo(Rdv::class,'rdv_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function paiement()
    {
        return $this->hasMany(PaiementRecu::class);
    }
}
