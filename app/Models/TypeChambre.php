<?php

namespace App\Models;
use App\Models\Societe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeChambre extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_type_chambre',
        'prix',
        'capacite',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
}
