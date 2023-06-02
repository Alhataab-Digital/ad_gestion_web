<?php

namespace App\Models;
use App\Models\Devise;
use App\Models\Caisse;
use App\Models\Utilisateur;
use App\Models\Fournisseur;
use App\Models\Client;
use App\Models\Region;
use App\Models\Agence;
use App\Models\TypePiece;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationTransfert extends Model
{
    use HasFactory;
    protected $fillable = [
            'client_id',
            'montant',
            'type_envoi',
            'frais_envoi',
            'montant_ttc',
            'taux_echange',
            'agence_id',
            'code_envoi',
            'devise_id',
            'envoi_user_id',
            'date_envoi',

            'region_id',
            'nom_destinataire',
            'telephone_destinataire',

            'type_piece_id',
            'numero_piece',
            'retrait_user_id',
            'date_retrait',

            'etat',
    ];

    public function piece()
    {
        return $this->belongsTo(TypePiece::class);
    }
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
    public function devise()
    {
        return $this->belongsTo(Devise::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
