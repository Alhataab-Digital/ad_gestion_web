<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class DetailDevis extends Model
{
    use HasFactory;
    protected $fillable=[
        'devis_id',
        'produit_id',
        'quantite_demandee',
        'prix_unitaire_demande',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
