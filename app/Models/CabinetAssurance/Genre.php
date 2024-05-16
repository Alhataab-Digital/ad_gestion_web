<?php

namespace App\Models\CabinetAssurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle_genre',
        'user_id',
        'societe_id',
    ];
}
