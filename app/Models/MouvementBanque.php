<?php

namespace App\Models;
use App\Models\Banque;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementBanque extends Model
{
    use HasFactory;

    protected $fillable = [
        'banque_id',
        'user_id',
        'description',
        'entree',
        'sortie',
        'solde',
        'date_comptable',
    ];

    public function banque()
    {
        return $this->belongsTo(Banque::class,'banque_id');
    }
}
