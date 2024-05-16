<?php

namespace App\Models\CabinetAssurance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;
    protected $fillable = [
        'code_usage',
        'libelle_usage',
        'user_id',
        'societe_id',
    ];
}
