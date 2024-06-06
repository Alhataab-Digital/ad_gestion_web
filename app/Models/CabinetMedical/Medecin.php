<?php

namespace App\Models\CabinetMedical;

use App\Livewire\CabinetMedical\TypeSpecialiste;
use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

     protected $fillable = [
        'civilite_id',
        'nom',
        'prenom',
        'situation_matrimoniale_id',
        'date_naissance',
        'lieu_naissance',
        'titre',
        'telephone',
        'adresse',
        'mail',
        'matricule',
        'specialite_id',
        'categorie_medicale_id',
        'espace_id',
        'user_id',
        'societe_id',
    ];

        public function specialite()
        {
            return $this->belongsTo(SpecialiteMedecin::class);
        }

        public function categorie()
        {
            return $this->belongsTo(CategorieMedecin::class,'categorie_medicale_id');
        }
        public function civilite()
        {
            return $this->belongsTo(Civilite::class);
        }

        public function situation()
        {
            return $this->belongsTo(SituationMatrimoniale::class,'situation_matrimoniale_id');
        }
        public function user()
        {
            return $this->belongsTo(Utilisateur::class);
        }

        public function societe()
        {
            return $this->belongsTo(Societe::class);
        }

}
