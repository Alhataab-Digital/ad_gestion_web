<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
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
        'mail',
        'password',
        'user_id',
        'societe_id',
    ];
}
