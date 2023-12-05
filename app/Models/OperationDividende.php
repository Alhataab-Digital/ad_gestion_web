<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationDividende extends Model
{
    use HasFactory;
    protected $fillable = [

        'montant_operation',
        'sens_operation',
        'reglement_id',
        'caisse_id',
        'investisseur_id',
        'user_id',
        'date_comptable',
];

    public function reglement()
    {
        return $this->belongsTo(TypeReglement::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function investisseur()
    {
        return $this->belongsTo(Investisseur::class,'investisseur_id');
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }
}
