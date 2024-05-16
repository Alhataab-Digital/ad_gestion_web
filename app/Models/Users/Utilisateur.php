<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\TypeGestion;
use App\Models\Societe;
use App\Models\Agences\Agence;
use App\Models\Caisse\Caisse;

class Utilisateur extends Model implements Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use BasicAuthenticatable;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'adresse',
        'password',
        'terms',
        'etat',
        'role_id',
        'societe_id',
        'agence_id',
        'gestion_id',

    ];

    public function gestion()
    {
        return $this->belongsTo(TypeGestion::class);
    }

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function caisses()
    {
        return $this->belongsToMany(Caisse::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
