<?php

namespace App\Models;

use App\Models\Agence;
use App\Models\CategorieProduit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_produit',
        'description_produit',
        'prix_unitaire_achat',
        'prix_unitaire_vente',
        'stock_min',
        'stock_max',
        'categorie_produit_id',
        'agence_id',
    ];

    public function categorie()
    {
        return $this->belongsTo(CategorieProduit::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
