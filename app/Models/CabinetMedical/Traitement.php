<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_ordre',
        'diagnostique',
        'conclusion',
        'consultation_id',
        'patient_id',
        'medecin_id',
        'user_id',
        'societe_id',
    ];
}
