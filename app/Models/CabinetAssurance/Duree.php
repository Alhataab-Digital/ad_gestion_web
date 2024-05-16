<?php

namespace App\Models\CabinetAssurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duree extends Model
{
    use HasFactory;
    protected $fillable = [
        'nbr_duree',
        'libelle_duree',
        'user_id',
        'societe_id',
    ];
}
