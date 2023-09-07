<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\reglement;

class OperationReglementFacture extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'facture_id',
        'type_reglement_id',
        'montant_operation',
    ];

    public function reglement()
    {
        return $this->belongsTo(TypeReglement::class,'type_reglement_id');
    }
}
