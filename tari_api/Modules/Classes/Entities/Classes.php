<?php

namespace Modules\Classes\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Classes\Database\factories\ClassesFactory::new();
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}