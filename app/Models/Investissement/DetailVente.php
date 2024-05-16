<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVente extends Model
{
    use HasFactory;
    protected $fillable = [
        'vente_id',
        'produit_id',
        'quantite_vendue',
        'prix_unitaire_vendu',
    ];
}
