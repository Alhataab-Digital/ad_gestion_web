<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementCaisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'caisse_id',
        'user_id',
        'description',
        'entree',
        'sortie',
        'solde',
        'date_comptable',
    ];
}
