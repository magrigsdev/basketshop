<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager, ManagerRegistry $doctrine): Response
    {
        if ($request->isMethod('POST')) {
            $confirmPassword = $request->request->get('confirmPassword');
            $Password = $request->request->get('password');

            if ($confirmPassword !== $Password) {
                return $this->render('register/index.html.twig', [
                    'controller_name' => 'RegisterController',
                    'page' => 'register',
                    'title' => 'BasketShop - Register',
                    'message' => 'Password and Confirm Password do not match!',
                ]);
            }

            $user = new User();

            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $email = $request->request->get('email');
            $address = $request->request->get('address');
            $postalcode = $request->request->get('postalcode');
            $city = $request->request->get('city');
            // $roles = $request->request->get('roles');
            $roles = 'ROLE_USER';

            // Create UserRepository and UserService instances
            $user_repository = new UserRepository($doctrine);
            $user_service = new UserService($user_repository);
            $user = $user_temp = $user_service->createUser(
                $email,
                $Password,
                [$roles],
                $firstName,
                $lastName,
                $address,
                $postalcode,
                $city
            );

            // If user creation failed (e.g., email already exists), handle the error
            if (null === $user_temp) {
                return $this->render('register/index.html.twig', [
                    'controller_name' => 'RegisterController',
                    'page' => 'register',
                    'title' => 'BasketShop - Register',
                    'message' => 'Email already exists! Please use a different email.',
                ]);
            } // end if user_temp is null

            // data save user
            if ($user_repository->save($user, true)) { // Redirection vers la page de login
                return $this->redirectToRoute('app_sign_in',
                    ['message' => 'Registration successful! Please log in.',
                        'page' => 'register', ]);
            }
        }
        // final of POST

        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'page' => 'register',
            'title' => 'BasketShop - Register',
            'message' => '', ]);
    }
}
