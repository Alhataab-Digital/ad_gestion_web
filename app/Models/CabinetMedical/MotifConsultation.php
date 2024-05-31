<?php

namespace App\Models\CabinetMedical;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotifConsultation extends Model
{
    use HasFactory;
    protected $fillable = [
        'motif',
    ];
}
