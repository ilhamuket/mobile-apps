<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'token', 'created_at'
    ];
    // protected $primary_key = null;
    // public $incrementing = false;

    public function getUpdatedAtColumn()
    {
        return null;
    }

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\PasswordResetFactory::new();
    }
}