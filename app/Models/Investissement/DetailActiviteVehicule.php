<?php

namespace App\Models\Investissement;

use App\Models\Investissement\Investisseur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
