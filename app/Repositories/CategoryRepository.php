<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getTopCategories()
    {
        return Category::withCount('events')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
    }
}
