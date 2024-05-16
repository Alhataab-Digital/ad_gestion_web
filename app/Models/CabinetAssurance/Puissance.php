<?php

namespace App\Models\CabinetAssurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puissance extends Model
{
    use HasFactory;
    protected $fillable = [
        'valeur_puissance',
        'devise_puissance',
        'user_id',
        'societe_id',
    ];
}
