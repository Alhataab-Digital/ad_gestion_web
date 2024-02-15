<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\reglement;
use App\Models\Facture;

class OperationReglementFacture extends Model
{
    use HasFactory;

    protected $fillable = [
        'facture_id',
        'type_reglement_id',
        'activite_id',
        'reglement_facture_id',
        'montant_operation',
    ];

    public function reglement()
    {
        return $this->belongsTo(TypeReglement::class,'type_reglement_id');
    }

    public function activite_investissement()
    {
        return $this->belongsTo(ActiviteInvestissement::class,'activite_id');
    }

    public function facture()
    {
        return $this->belongsTo(Facture::class,'facture_id');
    }
}
