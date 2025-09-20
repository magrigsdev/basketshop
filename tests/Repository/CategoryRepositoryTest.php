<?php

namespace App\Tests\Repository;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategoryRepositoryTest extends KernelTestCase
{
    private CategoryRepository $category_repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->category_repository = self::getContainer()->get(CategoryRepository::class);
    }

    public function testCreateCategory(): void
    {
        $category = new Category();
        $category->setName('Category Test3');
        $category->setDescription('Description Test2');
        $category_service = new CategoryService($this->category_repository);

        $category_created = $category_service->createCategory(
            $category->getName(),
            $category->getDescription()
            // adding description
        );

        $this->assertTrue($category_created['create'], 'Category with this name : '.$category->getName().' already exists.');
        $this->assertEquals('category created success', $category_created['message']);
        $this->assertNotNull($this->category_repository->save($category, true));
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
