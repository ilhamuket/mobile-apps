<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassesScheduleStudio extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'classes_schedule_studio';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\ClassesScheduleStudioFactory::new();
    }

    public function classes()
    {
        return $this->belongsTo(StudioClass::class, 'class_id');
    }

    //==== Scope ===//
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
}