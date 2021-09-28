<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewOwner extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'reviews';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\ReviewOwnerFactory::new();
    }
    public function class()
    {
        return $this->belongsTo(ClassesOwnerStudio::class, 'class_id');
    }
    public function studio()
    {
        return $this->belongsTo(OwnerStudio::class, 'studio_id');
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