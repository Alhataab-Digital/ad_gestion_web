<?php

namespace App\Models\Users;

use App\Models\Users\Utilisateur as UsersUtilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utilisateur;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role',
    ];

    public function users()
    {
        return $this->belongsToMany(UsersUtilisateur::class);
    }
}
