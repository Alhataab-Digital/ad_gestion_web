<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Devise;
use App\Models\Agence;

class DeviseAgence extends Model
{
    use HasFactory;
    protected $fillable = [
        'devise_id',
        'agence_id',
        'taux',
    ];

    public function devise()
    {
        return $this->belongsTo(Devise::class);
    }
    public function agence()
    {
        return $this->belongsTo(Agence::class);
    }
}
