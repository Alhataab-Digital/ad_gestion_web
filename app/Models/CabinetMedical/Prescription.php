<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
    'medicament_id',
    'quantite',
    'posologie',
    'duree',
    'consultation_id',
    'patient_id',
    'medecin_id',
    'user_id',
    'societe_id',
    ];

    public function medicament()
    {
        return $this->belongsTo(Medicament::class,'medicament_id');
    }
    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }
    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
