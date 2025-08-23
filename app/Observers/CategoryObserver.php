<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{

    public function creating(Category $category)
    {
        if (!empty($category->parent_id)) {
            $parent = Category::find($category->parent_id);
            if ($parent) {
                $category->appendToNode($parent);
            }
        }
    }
}
