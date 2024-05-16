<?php

namespace App\Models\CabinetAssurance;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimeNet extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'classe_id',
        'groupe_id',
        'zone_id',
        'energie_id',
        'puissance_id',
        'usage_id',
        'user_id',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function usage()
    {
        return $this->belongsTo(Usage::class);
    }

    public function puissance()
    {
        return $this->belongsTo(Puissance::class);
    }

    public function energie()
    {
        return $this->belongsTo(Energie::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
}
