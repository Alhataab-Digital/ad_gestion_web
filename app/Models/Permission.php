<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utilisateur;


class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'permission',
    ];

    public function users()
    {
        return $this->belongsToMany(Utilisateur::class);
    }
}
