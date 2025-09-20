<?php

namespace App\Tests\Repository;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
{
    private CategoryRepository $category_repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->category_repository = self::getContainer()->get(CategoryRepository::class);
    }

}
