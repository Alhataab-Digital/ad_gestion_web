<?php

namespace App\Models\Caisse;

use App\Models\Agences\Agence;
use App\Models\MoneyChange\Devise;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'montant_min',
        'montant_max',
        'compte',
        'compte_dividende_societe',
        'date_comptable',
        'devise_id',
        'user_id',
        'etat',
        'agence_id',
        'societe_id',
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class,'agence_id');
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function devise()
    {
        return $this->belongsTo(Devise::class);
    }

}
