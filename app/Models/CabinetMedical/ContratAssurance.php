<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratAssurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'maison_assurance_id',
        'tarif_consultation_id',
        'date_debut',
        'date_fin',
        'taux_couverture',
        'user_id',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class,'user_id');
    }
    public function maison_assurance()
    {
        return $this->belongsTo(MaisonAssurance::class,'maison_assurance_id');
    }

    public function tarif_consultation()
    {
        return $this->belongsTo(TarifConsultation::class);
    }

}
