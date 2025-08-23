<?php

namespace App\Models;

use App\Models\Traits\CategoryTrait;
use App\Observers\CategoryObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Kalnoy\Nestedset\NodeTrait;

#[ObservedBy([CategoryObserver::class])]
class Category extends Model
{
    use NodeTrait, CategoryTrait;
    protected $fillable = [
        'name','slug','parent_id','_lft','_rgt','depth'
    ];


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
