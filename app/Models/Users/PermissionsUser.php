<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionsUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'permission_id',
    ];
}
