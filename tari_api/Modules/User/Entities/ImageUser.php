<?php

namespace Modules\User\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class imageUser extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\ImageUserFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getUrlAttribute()
    {
        if ($this->attributes['url'] != null) {
            // return env('IMAGE_URL', ' http://127.0.0.1:8000/app') . $this->attributes['url'];
            return  env('IMAGE_URL', ' https://api.ensiklotari.com/app') . $this->attributes['url'];
        } else {
            return $this->attributes['url'];
        }
    }
}