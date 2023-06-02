<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieProduit extends Model
{
    use HasFactory;

    protected $fillable=[
        'nom_categorie_produit',
        'description_categorie_produit',
        'agence_id',
    ];
}
