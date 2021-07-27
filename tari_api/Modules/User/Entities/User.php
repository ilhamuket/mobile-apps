<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory, HasApiTokens, HasRoles;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserFactory::new();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    }
}