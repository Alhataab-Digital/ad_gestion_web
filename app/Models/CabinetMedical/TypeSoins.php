<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSoins extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_soins',
        'description',
    ];
}
