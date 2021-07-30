<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\CategoryFactory::new();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}