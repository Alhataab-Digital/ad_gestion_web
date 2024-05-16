<?php

namespace App\Models\Users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


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
