<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImgAlls extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\ImgAllsFactory::new();
    }
    public function getUrlAttribute()
    {
        if ($this->attributes['url'] != null) {
            // return  env('IMAGE_URL', ' http://127.0.0.1:8000/') . $this->attributes['url'];
            return  env('IMAGE_URL', ' https://api.ensiklotari.com/') . $this->attributes['url'];
        } else {
            return $this->attributes['url'];
        }
    }
}