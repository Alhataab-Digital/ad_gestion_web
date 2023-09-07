<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utilisateur;
use App\Models\Caisse;
use App\Models\Devise;

class OperationInterCaisse extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant_operation',
        'commentaire',
        'caisse_id',
        'caisse_destination_id',
        'taux',
        'date_comptable',
        'date_comptable_reception',
        'user_id',
        'user_destination_id',
        'etat'
    ];

    public function devise()
    {
        return $this->belongsTo(Devise::class);
    }

    public function caisse_destination()
    {
        return $this->belongsTo(Caisse::class, 'caisse_destination_id');
    }
    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }

    public function user_destination()
    {
        return $this->belongsTo(Utilisateur::class,'user_destination_id');
    }

    public function user()
    {
        return $this->belongsTo(Utilisateur::class);
    }


}

