<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FollowStudio extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'follow_studio';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\FollowStudioFactory::new();
    }
}