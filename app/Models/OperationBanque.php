<?php

namespace App\Models;
use App\Models\Utilisateur;
use App\Models\Banque;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationBanque extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'montant_operation',
        'description',
        'sens_operation',
        'piece',
        'banque_id',
        'commentaire',
        'user_id',
        'date_comptable',
    ];

    public function banque()
    {
        return $this->belongsTo(Banque::class);
    }

}
