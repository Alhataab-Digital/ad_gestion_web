<?php

namespace App\Models\Agences;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgenceUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'agence_id',
        'user_id',
    ];
}
