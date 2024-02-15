<?php

namespace App\Models;
use App\Models\Utilisateur;
use App\Models\Caisse;
use App\Models\Fournisseur;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationVehiculeAchete extends Model
{
    use HasFactory;

    protected $fillable = [
        'annee',
        'marque',
        'model',
        'chassis',
        'prix_achat',
        'charge_usa',
        'prix_revient',
        'fournisseur_id',
        'date_comptable',
        'etat',
        'sens_operation',
        'activite_id',
        'caisse_id',
        'user_id',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class,'fournisseur_id');
    }


    public function caisse()
    {
        return $this->belongsTo(Caisse::class,'caisse_id');
    }

    public function user()
    {
        return $this->belongsToMany(Utilisateur::class);
    }
}
