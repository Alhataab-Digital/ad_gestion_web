<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeActiviteInvestissement extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_activite',
        'agence_id',
    ];

}
