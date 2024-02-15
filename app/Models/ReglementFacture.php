<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglementFacture extends Model
{
    use HasFactory;

    protected $fillable = [
        'facture_id',
        'montant_regle',
        'montant_non_regle',
    ];
}
