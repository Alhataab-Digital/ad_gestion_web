<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agences\Agence ;
use App\Models\Caisse\Caisse;
use App\Models\Investissement\TypeActiviteInvestissement;
use App\Models\Users\Utilisateur;

class ActiviteInvestissement extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_activite_id',
        'capital_activite',
        'montant_decaisse',
        'compte_activite',
        'total_depense',
        'total_recette',
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
