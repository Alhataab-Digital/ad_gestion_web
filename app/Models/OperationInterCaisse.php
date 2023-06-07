<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utilisateur;
use App\Models\Caisse;

class OperationInterCaisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_operation',
        'commentaire',
        'caisse_id',
        'caisse_destination_id',
        'date_comptable',
        'date_comptable_reception',
        'user_id',
        'user_destination_id',
        'etat'
    ];


    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }


}

