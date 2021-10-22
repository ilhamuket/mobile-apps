<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class imgListClass extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'img_list_classes';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\ImgListClassFactory::new();
    }

    public function class()
    {
        return $this->belongsTo(StudioClass::class, 'class_id');
    }

    public function getUrlAttribute()
    {
        if ($this->attributes['url'] != null) {
            return env('IMAGE_URL', ' http://127.0.0.1:8000/app') . $this->attributes['url'];
            // return env('IMAGE_URL', ' https://api.ensiklotari.com/app') . $this->attributes['url'];
        } else {
            return $this->attributes['url'];
        }
    }
}