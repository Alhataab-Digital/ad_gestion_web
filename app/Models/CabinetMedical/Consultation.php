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
        'motif',
        'examen_clinique',
        'examen_biologique',
        'examen_radiologique',
        'diagnostique',
        'traitement',
        'patient_id',
        'planification_id',
        'tarif_medical_id',
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

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function planification()
    {
        return $this->belongsTo(PlanificationMedecin::class);
    }
}
