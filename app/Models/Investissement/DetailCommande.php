<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class DetailCommande extends Model
{
    use HasFactory;
    protected $fillable=[
        'commande_id',
        'produit_id',
        'quantite_commandee',
        'prix_unitaire_commande',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
