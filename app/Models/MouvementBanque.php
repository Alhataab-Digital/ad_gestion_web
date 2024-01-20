<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementBanque extends Model
{
    use HasFactory;

    protected $fillable = [
        'banque_id',
        'user_id',
        'description',
        'entree',
        'solde',
        'date_comptable',
    ];
}
