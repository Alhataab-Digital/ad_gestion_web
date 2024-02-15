<?php

namespace App\Models;
use App\Models\OperationVehiculeAchete;
use App\Models\Caisse;
use App\Models\Fournisseur;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationVehiculeVendu extends Model
{
    use HasFactory;

    protected $fillable = [
        'prix_vente',
        'marge',
        'taux_devise',
        'client_id',
        'date_comptable',
        'sens_operation',
        'etat',
        'activite_id',
        'operation_vehicule_achete_id',
        'caisse_id',
        'user_id',
    ];

    public function operation_vehicule_achete()
    {
        return $this->belongsTo(OperationVehiculeAchete::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function caisses()
    {
        return $this->belongsToMany(Caisse::class);
    }

    public function user()
    {
        return $this->belongsToMany(Utilisateur::class);
    }
}
