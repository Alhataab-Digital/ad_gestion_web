<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

     protected $fillable = [
        'civilite',
        'nom',
        'prenom',
        'situation',
        'age',
        'telephone',
        'adresse',
        'taille',
        'poid',
        'grade',
        'mail',
        'password',
        'user_id',
        'societe_id',
    ];
}
