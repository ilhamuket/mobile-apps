<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\CategoryFactory::new();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeVerified($query, $verified)
    {
        if ($verified == 'verified') {
            $query->where('isVerified', true);
        } else if ($verified == 'not_verified') {
            $query->where('isVerified', false);
        } else if ($verified == 'deleted') {
            $query->onlyTrashed();
        } else {
            return $query;
        }
    }
}