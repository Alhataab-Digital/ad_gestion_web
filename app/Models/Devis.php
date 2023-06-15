<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'user_id',
        'montant_total',
        'agence_id',
        'etat',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
