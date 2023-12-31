<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Investisseur;


class DetailActiviteVehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'activite_vehicule_id',
        'investisseur_id',
        'montant_investis',
        'taux',
    ];


    public function investisseur()
    {
        return $this->belongsTo(Investisseur::class);
    }

}
