<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiviteVehicule extends Model
{
    use HasFactory;
    protected $fillable = [
        'intitule',
        'capital_activite',
        'montant_ouverture',
        'montant_vente',
        'total_depense',
        'montant_benefice',
        'detail',
        'user_id',
        'caisse_id',
        'agence_id',
        'etat_activite',
        'date_comptable',
    ];

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
