<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecteurDepense extends Model
{
    use HasFactory;
    protected $fillable = [
        'secteur_depense',
    ];
}
