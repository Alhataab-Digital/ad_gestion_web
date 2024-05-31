<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;
    protected $fillable = [
        'denomination',
        'forme_pharmaceutique',
        'voies_administrative',
    ];
}
