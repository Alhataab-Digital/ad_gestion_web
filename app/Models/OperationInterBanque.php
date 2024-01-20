<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationInterBanque extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_operation',
        'commentaire',
        'banque_id',
        'banque_destination_id',
        'taux',
        'date_comptable',
        'date_comptable_reception',
        'user_id',
        'user_destination_id',
        'etat'
    ];
}
