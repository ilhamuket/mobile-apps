<?php

namespace Modules\Auth\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelHasRoles extends Model
{
    use HasFactory;

    protected $fillable = ['model_type'];
    protected $table = 'model_has_roles';

    protected static function newFactory()
    {
        return \Modules\Auth\Database\factories\ModelHasRolesFactory::new();
    }
}