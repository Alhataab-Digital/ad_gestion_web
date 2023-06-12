<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLivrer extends Model
{
    use HasFactory;
    protected $fillable=[
        'livrer_id',
        'produit_id',
        'quantite_livree',
        'prix_unitaire_livre',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
