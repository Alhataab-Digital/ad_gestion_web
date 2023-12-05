<?php

namespace App\Models\Detenu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetenuModel extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'civilite',
        'prenom',
        'nom',
        'nom_pere',
        'nom_mere',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'examen_medical',
        'date_detention',
        'date_liberation',
        'date_transfert',
        'motif_detention',
        'photo',
        'mineur',
        'maison_arret_id',
        'utilisateur_id',
        'etat',
    ];

}
