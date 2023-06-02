<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntrepotStock extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom_entrepot',
        'adresse_entrepot',
        'capacite_entrepot',
    ];
}
