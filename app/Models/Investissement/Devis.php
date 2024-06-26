<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\Agences\Agence;
use App\Models\Investissement\ActiviteInvestissement;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'user_id',
        'activite_id',
        'montant_total',
        'agence_id',
        'etat',
    ];

    public function activite()
    {
        return $this->belongsTo(ActiviteInvestissement::class,'activite_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
