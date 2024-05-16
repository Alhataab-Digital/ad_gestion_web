<?php

namespace App\Models\Users;

use App\Models\Users\Utilisateur as UsersUtilisateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Utilisateur;

class UserEnLigne extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'etat',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(UsersUtilisateur::class);
    }
}
