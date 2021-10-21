<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\StudioOwners\Entities\ReviewResponse;
use Modules\StudioOwners\Entities\StudioClassVidio;

class Reviews extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'reviews';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\ReviewsFactory::new();
    }

    public function class()
    {
        return $this->belongsTo(StudioClass::class, 'class_id');
    }
    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'like_user_reviews', 'review_id', 'user_likes');
    }

    public function report()
    {
        return $this->belongsToMany(User::class, 'report_user_reviews', 'review_id', 'user_report');
    }

    public function response()
    {
        return $this->hasMany(ReviewResponse::class, 'review_id');
    }

    public function classVidio()
    {
        return $this->belongsTo(StudioClassVidios::class, 'class_vidio_id');
    }

    public function scopeEntities($query, $entities)
    {
        if ($entities != null || $entities != '') {
            $entities = str_replace(' ', '', $entities);
            $entities = explode(',', $entities);

            try {
                return $query = $query->with($entities);
            } catch (\Throwable $th) {
                return Json::exception(null, validator()->errors());
            }
        }
    }
}