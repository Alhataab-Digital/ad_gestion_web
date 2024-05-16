<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturation extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'tarif_id',
        'planification_id',
        'etat',
        'montant',
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
        return $this->belongsTo(TarifMedical::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function planification()
    {
        return $this->belongsTo(PlanificationMedecin::class);
    }

}
