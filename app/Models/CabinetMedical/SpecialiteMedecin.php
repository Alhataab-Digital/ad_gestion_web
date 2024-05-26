<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialiteMedecin extends Model
{
    use HasFactory;
    protected $fillable = [
        'specialite_medecin',
        'description',
    ];
}
