<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementStock extends Model
{
    use HasFactory;
    protected $fillable=[
        'produit_id',
        'quantite',
        'type_mouvement',
        'entrepot_id',
        'prix_unitaire_produit'
    ];
}
