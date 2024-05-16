<?php

namespace App\Models\Caisse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaisseUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'caisse_id',
        'user_id',
    ];
}
