<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationVehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'annee',
        'marque',
        'model',
        'chassis',
        'prix_achat',
        'charge_usa',
        'prix_revient',
        'prix_vente',
        'marge',
        'fournisseur_id',
        'client_id',
        'date_comptable',
        'caisse_id',
        'user_id',
    ];

}
