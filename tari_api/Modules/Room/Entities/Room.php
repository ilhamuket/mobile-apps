<?php

namespace Modules\Room\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Studio\Entities\ClassesScheduleStudio;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Room\Database\factories\RoomFactory::new();
    }

    public function class()
    {
        return $this->belongsTo(ClassesScheduleStudio::class, 'sub_class_id');
    }
}