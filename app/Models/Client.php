<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_client',
        'sexe',
        'telephone',
        'adresse',
        'email',
        'type_client_id',
        'societe_id',
    ];
}
