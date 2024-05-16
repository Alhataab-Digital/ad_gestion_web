<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficeActivite extends Model
{
    use HasFactory;
    protected $fillable=[
        'montant_investisseur',
        'taux_repartition',
        'activite_id',
        'date_operation',
    ];
}
