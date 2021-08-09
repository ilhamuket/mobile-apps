<?php

namespace Modules\Classes\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theory extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Classes\Database\factories\TheoryFactory::new();
    }

    public function posts()
    {
        return $this->hasMany(Classes::class);
    }
}