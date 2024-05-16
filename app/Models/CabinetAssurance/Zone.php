<?php

namespace App\Models\CabinetAssurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_zone',
        'libelle_zone',
        'user_id',
        'societe_id',
    ];
}
