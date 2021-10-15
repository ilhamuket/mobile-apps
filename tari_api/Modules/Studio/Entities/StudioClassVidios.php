<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudioClassVidios extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'studio_class_vidio';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioClassVidiosFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}