<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CategoryService
{
    private CategoryRepository $category_repository;

    public function __construct(CategoryRepository $category_repository)
    {
        $this->category_repository = $category_repository;
    }

    public function createCategory(string $name, string $description): array
    {
        $category = new Category();
        $category->setName($name);
        $category->setDescription($description);

        if ($this->category_repository->findOneBy(['name' => $name])) {
            return ['create' => false, 'message' => 'Category with this name : '.$name.' already exists.'];
        } else {
            return ['create' => true, 'message' => 'category created success'];
        }
    }
}
