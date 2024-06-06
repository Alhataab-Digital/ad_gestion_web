<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'resultat',
        'type_examen_id',
        'consultation_id',
        'patient_id',
        'medecin_id',
        'user_id',
        'societe_id',
        ];

        public function type_examen()
        {
            return $this->belongsTo(TypeExamen::class,'type_examen_id');
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
