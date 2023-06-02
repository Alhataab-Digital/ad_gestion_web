<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeGestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'gestion',
    ];
}
