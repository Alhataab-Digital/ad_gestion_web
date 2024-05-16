<?php

namespace App\Models\MoneyChange;

use App\Models\Caisse\Caisse;
use App\Models\Client;
use App\Models\Fournisseur;
use App\Models\TypeReglement;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationDevise extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_operation',
        'sens_operation',
        'client_id',
        'devise_id',
        'taux',
        'coefficient',
        'benefice',
        'reglement_id',
        'date_comptable',
        'caisse_id',
        'user_id',
    ];

    public function devise()
    {
        return $this->belongsTo(Devise::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function reglement()
    {
        return $this->belongsTo(TypeReglement::class);
    }
}
