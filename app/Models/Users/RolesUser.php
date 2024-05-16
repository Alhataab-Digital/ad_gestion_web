<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;
use App\Models\Utilisateur;

class RolesUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role_id',
    ];





}
