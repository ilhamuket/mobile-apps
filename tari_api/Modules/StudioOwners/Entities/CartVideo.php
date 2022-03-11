<?php

namespace Modules\StudioOwners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartVideo extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\CartVideoFactory::new();
    }

    public function form()
    {
        return $this->hasOne(FormRegisterEnsiklovideo::class, 'cart_video_id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->attributes['image_url'] != null) {
            return  env('IMAGE_URL', ' http://127.0.0.1:8000/app/') . $this->attributes['image_url'];
            // return env('IMAGE_URL', ' https://api.ensiklotari.com/app/') . $this->attributes['url'];
        } else {
            return $this->attributes['image_url'];
        }
    }
}
