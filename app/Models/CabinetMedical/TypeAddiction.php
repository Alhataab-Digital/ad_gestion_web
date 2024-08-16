<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAddiction extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_addiction',
    ];
}
