<?php

namespace App\Models\Agences;

use App\Models\MoneyChange\Devise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\Societe;
use App\Models\Users\Utilisateur;

class Agence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'telephone',
        'email',
        'compte_agence',
        'societe_id',
        'devise_id',
        'region_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function devise()
    {
        return $this->belongsTo(Devise::class);
    }

    public function users()
    {
        return $this->belongsToMany(Utilisateur::class, 'agences_users' ,'agence_id', 'user_id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
