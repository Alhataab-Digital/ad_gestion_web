<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investisseur extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'heritier',
        'compte_investisseur',
        'compte_dividende',
        'etat',
        'agence_id',
        'date_creation',
    ];

}
