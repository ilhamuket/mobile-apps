<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Classes\Entities\Classes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\PostFactory::new();
    }

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}