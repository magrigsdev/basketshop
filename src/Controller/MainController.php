<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function main(ProductRepository $product_repository): Response
    {
        return $this->render('main/index.html.twig', [
            'title' => 'BasketShop - Home',
            'description' => 'Welcome to BasketShop, your one-stop shop for all your basket needs. Explore our wide range of products and enjoy a seamless shopping experience.',
            'keywords' => 'basket, shop, online shopping, ecommerce, products',
            'page' => 'main', // Specify the current page for active navigation
            'status' => 'offline',
<<<<<<< HEAD
=======
            'products' => $product_repository,
>>>>>>> interface-home
        ]);
    }
}
