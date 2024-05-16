<?php

namespace App\Models\CabinetAssurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Energie extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle_energie',
        'user_id',
        'societe_id',
    ];
}
