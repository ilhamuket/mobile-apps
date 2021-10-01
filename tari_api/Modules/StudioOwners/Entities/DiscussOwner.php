<?php

namespace Modules\StudioOwners\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscussOwner extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'discusses';

    protected static function newFactory()
    {
        return \Modules\StudioOwners\Database\factories\DiscussOwnerFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function parent()
    {
        return $this->belongsTo(DiscussOwner::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(DiscussOwner::class, 'parent_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassesOwnerStudio::class, 'class_id');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($discuss) { // before delete() method call this
            $discuss->child()->each(function ($photo) {
                $photo->delete(); // <-- direct deletion
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