<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Brryfrmnn\Transformers\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioFactory::new();
    }

    public function member()
    {
        return $this->hasMany(User::class, 'studio_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function img()
    {
        return $this->hasOne(ImagesStudio::class, 'studio_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_studio', 'studio_id', 'user_id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'like_studio', 'studio_id', 'user_id');
    }

    // ==== Scope ==== //

    public function scopeSearch($query, $search)
    {
        if ($search !== null) {
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        return $query;
    }

    public function scopeSort($query, $sorts)
    {
        if ($sorts != null || $sorts != '') {
            $sorts = explode(',', str_replace(' ', '', $sorts));
            foreach ($sorts as $sort) {
                $field = preg_replace('/[-]/', '', $sort);
                if (substr($sort, 0, 1) == '-') {
                    $query = $query->orderBy($field, 'desc');
                } else {
                    $query = $query->orderBy($field, 'asc');
                }
            }
        } else {
            $query = $query->orderBy('id', 'asc');
        }

        return $query;
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