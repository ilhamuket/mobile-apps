<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class studioArticle extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'articles';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioArticleFactory::new();
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}