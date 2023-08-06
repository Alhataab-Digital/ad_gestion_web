<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class DetailReceptionProduit extends Model
{
    use HasFactory;

    protected $fillable=[
        'reception_id',
        'produit_id',
        'quantite_recu',
        'prix_unitaire_recu',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
