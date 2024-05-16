<?php
namespace App\Models\Investissement;

use App\Models\Agences\Agence ;
use App\Models\Caisse\Caisse ;
use App\Models\Societe;
use App\Models\Users\Utilisateur;
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
        'taux_devise',
        'detail',
        'user_id',
        'caisse_id',
        'agence_id',
        'societe_id',
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
    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
}
