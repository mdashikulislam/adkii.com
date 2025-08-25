<?php

namespace App\Models;

use App\Models\Traits\CategoryTrait;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Translatable\HasTranslations;

#[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    use NodeTrait;
    use CategoryTrait;
    use HasTranslations;
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'hide_description',
        'image_path',
        'icon_class',
        'seo_title',
        'seo_description',
        'seo_keywords',
        '_lft',
        '_rgt',
        'is_for_permanent',
        'active',
    ];
    public array $translatable = ['name', 'description', 'seo_title', 'seo_description', 'seo_keywords'];

    //Database Relationship
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->with('children')
            ->orderBy('_lft');
    }

    //Scope section
    public function scopeRoot($query)
    {
        return $this->whereNull('parent_id');
    }

}
