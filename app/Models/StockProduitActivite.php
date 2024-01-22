<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduitActivite extends Model
{
    use HasFactory;
    protected $fillable = [
        'produit_id',
        'activite_id',
        'quantite_en_stock',
        'agence_id',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function activite()
    {
        return $this->belongsTo(EntrepotStock::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
