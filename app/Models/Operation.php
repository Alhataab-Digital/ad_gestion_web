<?php

namespace App\Models;
use App\Models\Devise;
use App\Models\Caisse;
use App\Models\Utilisateur;
use App\Models\Fournisseur;
use App\Models\Client;
use App\Models\reglement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_operation',
        'sens_operation',
        'client_id',
        'fournisseur_id',
        'devise_id',
        'taux',
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
