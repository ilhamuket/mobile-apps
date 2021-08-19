<?php

namespace Modules\Studio\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommentStudioVidio extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Studio\Database\factories\CommentStudioVidioFactory::new();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vidio()
    {
        return $this->belongsTo(StudioVidio::class, 'studio_vidio_id');
    }

    public function parent()
    {
        return $this->belongsTo(CommentStudioVidio::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(CommentStudioVidio::class, 'parent_id');
    }
}