<?php

namespace App\Models;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $fillable =[
        'raison_sociale',
        'activite',
        'forme_juridique',
        'region_id',
        'telephone',
        'email',
        'code_postal',
        'adresse',
        'complement',
        'site_web',
        'logo',
        'compte_societe',
        'compte_securite',
        'admin_id',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
