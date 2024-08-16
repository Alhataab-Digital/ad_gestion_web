<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeHospitalisation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_hospitalisation',
        'tarif_hospitalisation',
    ];
}
