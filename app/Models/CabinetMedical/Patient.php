<?php

namespace App\Models\CabinetMedical;

use App\Models\Civilite;
use App\Models\SituationMatrimoniale;
use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'civilite_id',
        'nom',
        'prenom',
        'situation_matrimoniale_id',
        'profession',
        'conjoint',
        'date_naissance',
        'lieu_naissance',

        'telephone',
        'adresse',
        'complement_adresse',
        'mail',
        'personne_contact',

        'numero_patient',
        'taille',
        'poid',
        'temperature',
        'groupe_sanguin',
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

    public function civilite()
    {
        return $this->belongsTo(Civilite::class,'civilite_id');
    }

    public function situation()
    {
        return $this->belongsTo(SituationMatrimoniale::class, 'situation_matrimoniale_id');
    }
}
