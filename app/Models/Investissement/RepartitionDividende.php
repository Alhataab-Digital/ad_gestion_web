<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Investissement\Investisseur;

class RepartitionDividende extends Model
{
    use HasFactory;
    protected $fillable =[
        'investisseur_id',
        'activite_id',
        'montant_investis',
        'dividende_gagner',
    ];

    public function investisseur()
    {
        return $this->belongsTo(Investisseur::class);
    }

}
