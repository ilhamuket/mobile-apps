<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImagesStudio extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'img_studio';
    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\ImagesStudioFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function getUrlAttribute()
    {
        if ($this->attributes['url'] != null) {
            return  env('IMAGE_URL', 'http://127.0.0.1:8000/') . $this->attributes['url'];
        } else {
            return $this->attributes['url'];
        }
    }
}