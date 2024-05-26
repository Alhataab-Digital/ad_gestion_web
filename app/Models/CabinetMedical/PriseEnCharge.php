<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriseEnCharge extends Model
{
    use HasFactory;
    protected $fillable = [
        'contrat_assurance_id',
        'maison_assurance_id',
        'patient_id',
        'nom_assurer',
        'confirm_assurer',
        'numero_assurer',
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

    public function contrat_assurance()
    {
        return $this->belongsTo(ContratAssurance::class,'contrat_assurance_id');
    }
    public function maison_assurance()
    {
        return $this->belongsTo(MaisonAssurance::class,'maison_assurance_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
