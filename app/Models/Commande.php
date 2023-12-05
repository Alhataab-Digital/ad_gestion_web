<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActiviteInvestissement;
use App\Models\Fournisseur;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'fournisseur_id',
        'user_id',
        'montant_total',
        'activite_id',
        'agence_id',
        'etat',
    ];

    public function activite()
    {
        return $this->belongsTo(ActiviteInvestissement::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
