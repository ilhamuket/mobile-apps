<?php

namespace Modules\Classes\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


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
        return $this->belongsToMany(Classes::class, 'class_schedules', 'schedule_id', 'class_id');
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
}