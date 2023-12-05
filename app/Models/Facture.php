<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EntrepotStock;
use App\Models\Devis;
use App\Models\Client;


class Facture extends Model
{
    use HasFactory;
    protected $fillable = [
        'devis_id',
        'client_id',
        'entrepot_id',
        'activite_id',
        'user_id',
        'montant_total',
        'montant_regle',
        'agence_id',
        'etat',
    ];

    public function entrepot_stock()
    {
        return $this->belongsTo(EntrepotStock::class, 'entrepot_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function devis()
    {
        return $this->belongsTo(Devis::class,'devis_id');
    }
}
