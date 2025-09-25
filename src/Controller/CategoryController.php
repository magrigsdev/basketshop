<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    private ManagerRegistry $registry;

    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $category_repository): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'title' => 'Category Page',
            'page' => 'category', // Specify the current page for active navigation
            'categories' => $category_repository->findAll(),
        ]);
    }
}
