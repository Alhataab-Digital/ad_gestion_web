<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utilisateur;
use App\Models\Caisse;
use App\Models\Agence;

class ActiviteInvestissement extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_activite_id',
        'capital_activite',
        'montant_decaisse',
        'total_depense',
        'montant_benefice',
        'taux_devise',
        'commentaire',
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
    public function type_activite()
    {
        return $this->belongsTo(TypeActiviteInvestissement::class);
    }

}
