<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationDepenseActivite extends Model
{
    use HasFactory;
    protected $fillable = [
        'activite_investissement_id',
        'secteur_depense_id',
        'montant_depense',
    ];
}
