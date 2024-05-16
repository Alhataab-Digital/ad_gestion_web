<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeActiviteInvestissement extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_activite',
        'societe_id',
    ];

}
