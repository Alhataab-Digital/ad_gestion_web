<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProduit extends Model
{
    use HasFactory;
    protected $fillable = [
        'produit_id',
        'entrepot_id',
        'quantite_en_stock',
        'agence_id',
    ];
}
