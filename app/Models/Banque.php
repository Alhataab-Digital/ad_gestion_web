<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agence;
use App\Models\Utilisateur;
use App\Models\Societe;
class Banque extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'numero_compte_banque',
        'compte',
        'user_id',
        'etat',
        'agence_id',
        'societe_id',
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
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

