<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(): Response
    {
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
            'title' => 'BasketShop - About Us',
            'description' => 'Learn more about BasketShop, our mission, values, and the team behind your favorite basket products. We are committed to providing quality and service.',
            'keywords' => 'about us, basket shop, company information, team, mission',
            'page'=> 'about', // Specify the current page for active navigation
        ]);
    }
}
