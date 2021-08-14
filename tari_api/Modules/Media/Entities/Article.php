<?php

namespace Modules\Media\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Studio\Entities\Studio;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\ArticleFactory::new();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }
}