<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Investissement\SecteurDepense;

class OperationDepenseActivite extends Model
{
    use HasFactory;
    protected $fillable = [
        'activite_id',
        'secteur_depense_id',
        'montant_depense',
    ];

    public function secteur_depense()
    {
        return $this->belongsTo(SecteurDepense::class);
    }

}
