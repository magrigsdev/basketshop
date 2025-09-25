<?php

namespace App\Tests\Repository;

use App\Entity\Category;
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

    public function testRecordExist(): void
    {
        $category = new Category();
        $category->setName('lux');
        $category->setDescription('description ...');
        $isExist = $this->category_repository->recordExists(['name' => 'lux', 'description' => 'descript ...']);
        $this->assertFalse($isExist, 'the category does not exist');
    }

    public function testGetAllCategories(): void
    {
        $categories = $this->category_repository->getAll();
        $this->assertIsArray($categories);
        $this->assertNotEmpty($categories);
        foreach ($categories as $category) {
            $this->assertInstanceOf(Category::class, $category);
        }
    }
}
