<?php

namespace App\Models\Agences;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agences\Agence;
use App\Models\MoneyChange\Devise;

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
