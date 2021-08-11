<?php

namespace Modules\Classes\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Media\Entities\Post;

class Classes extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $casts = ['responses' => 'array'];

    protected static function newFactory()
    {
        return \Modules\Classes\Database\factories\ClassesFactory::new();
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function posts()
    {
        return $this->hasOne(Post::class, 'class_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'class_id');
    }

    public function scopeSummary($query, $sumaary)
    {
        if ($sumaary == 'intermediate') {
            $query->whereHas('posts', function (Builder $query) use ($sumaary) {
                $query->where('type', $sumaary);
            });
        } else if ($sumaary == 'beginner') {
            $query->whereHas('posts', function (Builder $query) use ($sumaary) {
                $query->where('type', $sumaary);
            });
        } else if ($sumaary == 'advanced') {
            $query->whereHas('posts', function (Builder $query) use ($sumaary) {
                $query->where('type', $sumaary);
            });
        } else if ($sumaary == 'verified') {
            $query->where('isVerified', 1);
        } else if ($sumaary == 'unverified') {
            $query->where('isVerified', 0);
        } else if ($sumaary == 'deleted') {
            $query->onlyTrashed();
        }

        return $query;
    }
}