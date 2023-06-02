<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeService extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom_type_service',
        'prix',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
}
