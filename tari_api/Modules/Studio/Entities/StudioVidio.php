<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudioVidio extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'studioVidios';

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\StudioVidioFactory::new();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }
}