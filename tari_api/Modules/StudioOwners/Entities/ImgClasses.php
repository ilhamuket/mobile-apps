<?php

namespace Modules\StudioOwners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class imgClasses extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'img_studio_classes';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\ImgClassesFactory::new();
    }

    public function class()
    {
        return $this->belongsTo(ClassesOwnerStudio::class, 'class_id');
    }

    public function getUrlAttribute()
    {
        if ($this->attributes['url'] != null) {
            return  env('IMAGE_URL', ' http://127.0.0.1:8000/') . $this->attributes['url'];
        } else {
            return $this->attributes['url'];
        }
    }
}