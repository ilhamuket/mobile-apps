<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewOwner extends Model
{
    use HasFactory, SoftDeletes;

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

    public function classVidio()
    {
        return $this->belongsTo(StudioClassVidio::class, 'class_vidio_id');
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

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($reviews) { // before delete() method call this
            $reviews->likes()->each(function ($data) {
                $data->detach(); // <-- direct deletion
            });
            $reviews->report()->each(function ($data) {
                $data->detach(); // <-- direct deletion
            });
        });
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