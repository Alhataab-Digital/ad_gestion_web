<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifConsultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'type_consultation_id',
        'user_id',
        'societe_id',
    ];

    public function type_consultation()
    {
        return $this->belongsTo(TypeConsultation::class,'type_consultation_id');
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
