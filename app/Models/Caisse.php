<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agence;
use App\Models\Utilisateur;

class Caisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'montant_min',
        'montant_max',
        'compte',
        'date_comptable',
        'devise_id',
        'user_id',
        'etat',
        'agence_id',
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

}
