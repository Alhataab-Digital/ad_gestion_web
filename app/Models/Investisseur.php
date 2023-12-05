<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Societe;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Agence;


class Investisseur extends Model implements Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    use BasicAuthenticatable;

    protected $fillable = [
        'code',
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'heritier',
        'montant_investis',
        'compte_investisseur',
        'compte_dividende',
        'etat',
        'agence_id',
        'societe_id',
        'date_creation',
    ];

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
