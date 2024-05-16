<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fournisseur;
use App\Models\Agences\Agence;
use App\Models\Investissement\ActiviteInvestissement;

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

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
