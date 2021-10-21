<?php

namespace Modules\StudioOwners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Studio\Entities\Reviews;

class ReviewResponse extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\ReviewResponseFactory::new();
    }

    public function review()
    {
        return $this->belongsTo(Reviews::class, 'review_id');
    }
}