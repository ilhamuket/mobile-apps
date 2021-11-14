<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserHasVideo extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\UserHasVideoFactory::new();
    }
}
