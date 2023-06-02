<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livrer extends Model
{
    use HasFactory;

    protected $fillable = [
        'fournisseur_id',
        'user_id',
        'montant_total',
        'agence_id',
        'etat',
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
}
