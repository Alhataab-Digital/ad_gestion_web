<?php

namespace App\Models\MoneyChange;

use App\Models\Caisse\Caisse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'montant',
        'devise_id',
        'caisse_id',
    ];

    public function devise()
    {
        return $this->belongsTo(Devise::class);
    }

    public function caisse()
    {
        return $this->belongsTo(Caisse::class);
    }
}
