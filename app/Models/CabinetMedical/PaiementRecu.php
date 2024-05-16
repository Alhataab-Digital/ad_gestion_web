<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\TypeReglement;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaiementRecu extends Model
{
    use HasFactory;
    protected $fillable = [
        'reglement_id',
        'facturation_id',
        'montant',
        'user_id',
        'societe_id',
    ];

    public function reglement()
    {
        return $this->belongsTo(TypeReglement::class);
    }

    public function recu()
    {
        return $this->belongsTo(Facturation::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
}
