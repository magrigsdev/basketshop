<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    // #[Route('/main', name: 'app_main')]
    // public function main(): Response
    // {
    //     return $this->render('main/index.html.twig', [
    //         'controller_name' => 'MainController',
    //     ]);
    // }

    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
       return new Response('bonjour ! welcome ');   
    }
}
