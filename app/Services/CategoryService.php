<?php

namespace App\Services;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getTopCategories(): Collection
    {
        return $this->categoryRepository->getTopCategories();
    }
}
