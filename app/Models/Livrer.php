<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\client;
use App\Models\EntrepotStock;

class Livrer extends Model
{
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'fournisseur_id',
        'entrepot_id',
        'user_id',
        'montant_total',
        'agence_id',
        'etat',
    ];

    public function client()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function entrepot()
    {
        return $this->belongsTo(EntrepotStock::class);
    }
}
