<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\RoomFactory::new();
    }

    public function class()
    {
        return $this->belongsTo(ClassesScheduleStudio::class, 'sub_class_id');
    }
}