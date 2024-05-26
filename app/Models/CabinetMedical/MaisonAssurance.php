<?php

namespace App\Models\CabinetMedical;

use App\Models\Societe;
use App\Models\Users\Utilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaisonAssurance extends Model
{
    use HasFactory;
    protected $fillable = [
        'maison_assurance',
        'telephone',
        'adresse',
        'mail',
        'user_id',
        'societe_id',
    ];


        public function user()
        {
            return $this->belongsTo(Utilisateur::class);
        }

        public function societe()
        {
            return $this->belongsTo(Societe::class);
        }
}
