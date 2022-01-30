<?php

namespace Modules\Media\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Studio\Entities\Studio;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Media\Database\factories\ArticleFactory::new();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class, 'studio_id');
    }

    // === scope === //

    public function scopeEntities($query, $entities)
    {
        if ($entities != null || $entities != '') {
            $entities = str_replace(' ', '', $entities);
            $entities = explode(',', $entities);

            try {
                return $query = $query->with($entities);
            } catch (\Throwable $th) {
                return Json::exception(null, validator()->errors());
            }
        }
    }

    public function scopeSummary($query, $summary, $studio_id)
    {
        if ($summary == 'publish') $query->where('studio_id', $studio_id)->where('status', 'publish');
        if ($summary == 'draft') $query->where('studio_id', $studio_id)->where('status', 'draft');
        if ($summary == 'new') $query->where('studio_id', $studio_id)->whereDate('created_at', now());

        return $query;
    }
}
