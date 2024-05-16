<?php

namespace App\Models\MoneyChange;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devise extends Model
{
    use HasFactory;

    protected $fillable = [
        'monnaie',
        'devise',
        'unite',
        'societe_id',
    ];



}
