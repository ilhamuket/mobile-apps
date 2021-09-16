<?php

namespace Modules\Studio\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class imgListClass extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'img_list_classes';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\ImgListClassFactory::new();
    }

    public function class()
    {
        return $this->belongsTo(StudioClass::class, 'class_id');
    }
}