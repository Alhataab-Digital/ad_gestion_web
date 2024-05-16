<?php

namespace App\Models\CabinetAssurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_groupe',
        'libelle_groupe',
        'user_id',
        'societe_id',
    ];
}
