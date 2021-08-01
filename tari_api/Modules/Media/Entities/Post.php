<?php

namespace Modules\Media\Entities;

use App\Models\User;
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}