<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getTopCategories(): Collection
    {
        return Category::withCount('events')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();
    }
}
