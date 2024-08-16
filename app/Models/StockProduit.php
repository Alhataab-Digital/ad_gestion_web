<?php

namespace App\Models;

use App\Models\Agences\Agence;
use App\Models\Investissement\EntrepotStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produit;

class StockProduit extends Model
{
    use HasFactory;
    protected $fillable = [
        'produit_id',
        'entrepot_id',
        'quantite_en_stock',
        'agence_id',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    public function entrepot()
    {
        return $this->belongsTo(EntrepotStock::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
