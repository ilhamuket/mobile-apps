<?php

namespace Modules\User\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\OtpFactory::new();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}
