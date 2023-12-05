<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\fournisseur;
use App\Models\EntrepotStock;

class ReceptionProduit extends Model
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

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function entrepot()
    {
        return $this->belongsTo(EntrepotStock::class);
    }
}
