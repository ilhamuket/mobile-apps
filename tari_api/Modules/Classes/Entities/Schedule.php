<?php

namespace Modules\Classes\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Media\Entities\Post;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];


    protected static function newFactory()
    {
        return \Modules\Classes\Database\factories\ScheduleFactory::new();
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, 'schedule_id');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'class_id');
    }

    public function getStatusAttribute()
    {
        $status = '';

        if ($this->start_at  <= now()->toDateString() && $this->end_at >= now()->toDateString()) {
            $status = 'ongoing';
        } else if ($this->start_at > now()->toDateString()) {
            $status = 'upcoming';
        } else if ($this->start_at < now()->toDateString()) {
            $status = 'missed';
        }

        return $status;
    }

    public function scopeSearch($query, $q)
    {
        if ($q != '' && $q != null) {
            $query->where('name', 'like', '%' . $q . '%');
        } else {
            $query;
        }
    }

    public function scopeDate($query, $start_at)
    {
        if ($start_at != null) {
            return $query->whereDate('start_at', '==', $start_at);
        }
        return $query;
    }
}