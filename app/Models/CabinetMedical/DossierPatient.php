<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossierPatient extends Model
{
    use HasFactory;
    protected $fillable = [
        'rdv_id',
        'etat',
        'montant',
        'date_operation',
        'user_id',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function rdv()
    {
        return $this->belongsTo(Rdv::class,'tarif_id');
    }
}
