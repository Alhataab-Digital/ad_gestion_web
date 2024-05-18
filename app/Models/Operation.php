<?php

namespace App\Models;

use App\Models\Agences\Agence;
use App\Models\Caisse\Caisse;
use App\Models\Investissement\NatureOperationCharge;
use App\Models\MoneyChange\Devise;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_operation',
        'sens_operation',
        'nature_operation_charge_id',
        'commentaire',
        'fichier',
        'date_comptable',
        'caisse_id',
        'agence_id',
        'societe_id',
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

    public function agence()
    {
        return $this->belongsTo(Agence::class);
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

    public function nature_operation_charge()
    {
        return $this->belongsTo(NatureOperationCharge::class,'nature_operation_charge_id');
    }
}
