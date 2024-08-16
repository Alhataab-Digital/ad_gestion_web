<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SigneVitaux extends Model
{
    use HasFactory;
    protected $fillable = [
        'poid',
        'taille',
        'temperature_corporelle',
        'frequence_cardiaque',
        'frequence_respiratoire',
        'pression_arterielle',
        'saturation_oxygene',
        'douleur',
        'numero_ordre',
        'patient_id',
        'medecin_id',
        'user_id',
        'societe_id',
        ];


        public function consultation()
        {
            return $this->belongsTo(Consultation::class, 'consultation_id');
        }
        public function medecin()
        {
            return $this->belongsTo(Medecin::class, 'medecin_id');
        }
        public function patient()
        {
            return $this->belongsTo(Patient::class, 'patient_id');
        }
        public function societe()
        {
            return $this->belongsTo(Societe::class);
        }

        public function user()
        {
            return $this->belongsTo(Utilisateur::class);
        }
}
