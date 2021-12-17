<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discuss extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\DiscussFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function parent()
    {
        return $this->belongsTo(Discuss::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(Discuss::class, 'parent_id');
    }

    public function class()
    {
        return $this->belongsTo(StudioClass::class, 'class_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'discuss_like', 'discuss_id', 'user_id');
    }
    // public function likes()
    // {
    //     return $this->belongsToMany(User::class, 'discuss_report', 'discuss_id', 'user_id');
    // }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($discustion) { // before delete() method call this
            if ($discustion->parent()) {
                $discustion->parent()->each(function ($items) {
                    $items->delete(); // <-- direct deletion
                });
            }
        });
    }

    // === Scope === //
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
