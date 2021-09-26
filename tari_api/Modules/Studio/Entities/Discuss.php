<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discuss extends Model
{
    use HasFactory;

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
}