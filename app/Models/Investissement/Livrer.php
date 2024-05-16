<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\client;
use App\Models\Agences\Agence;
use App\Models\Fournisseur;
use App\Models\Investissement\Commande;
use App\Models\Investissement\EntrepotStock;

class Livrer extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'fournisseur_id',
        'entrepot_id',
        'user_id',
        'montant_total',
        'agence_id',
        'etat',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function entrepot()
    {
        return $this->belongsTo(EntrepotStock::class);
    }

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
