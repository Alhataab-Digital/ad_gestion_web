<?php

namespace App\Models\Investissement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NatureOperationCharge extends Model
{
    use HasFactory;
    protected $fillable = [
        'nature_operation_charge',
    ];
}
