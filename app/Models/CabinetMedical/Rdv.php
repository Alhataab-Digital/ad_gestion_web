<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'medecin_id',
        'date_rdv',
        'heure_rdv',
        'etat_rdv',
        'user_id',
        'societe_id',
    ];

}
