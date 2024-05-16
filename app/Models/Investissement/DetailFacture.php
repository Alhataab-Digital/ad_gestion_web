<?php

namespace App\Models\Investissement;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailFacture extends Model
{
    use HasFactory;
    protected $fillable=[
        'facture_id',
        'produit_id',
        'quantite_vendue',
        'prix_unitaire_vendu',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
