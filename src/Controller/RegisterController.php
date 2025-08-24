<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET','POST'])]
    public function index(Request $request): Response
    {
       
    
         if($request->isMethod('POST'))
            {
                $confirmPassword = $request->request->get('confirmPassword');
                $Password = $request->request->get('password');
                if($confirmPassword !== $Password){
                    return $this->render('register/index.html.twig', [
                        'controller_name' => 'RegisterController',
                        'page' => 'register',
                        'title' => 'BasketShop - Register',
                        'message' => 'Password and Confirm Password do not match!',
                    ]);
                }
                
                // Redirect to a success page or login page after registration
                // return $this->redirectToRoute('app_login');
                // return $this->render('main/index.html.twig', [
                //         'controller_name' => 'RegisterController',
                //         'page' => 'main',
                //         'title' => 'registre test',
                //         'status' => 'online'
                // ]);
                // Redirection vers la page de login
                return $this->redirectToRoute('app_sign_in',['message' => 'Registration successful! Please log in.']);

                // $firstName = $request->request->get('firstName');
                // $lastName = $request->request->get('lastName');
                // $email = $request->request->get('email');
                // $password = $request->request->get('password');
                // $address = $request->request->get('address');
                // $postalCode = $request->request->get('postalCode');
                // $city = $request->request->get('city');

                //Validate the input data (you can add more validation as needed)
                // if(empty($firstName) || empty($email) || empty($password) || empty($address) || empty($postalCode) || empty($city)) {
                //     // Handle validation errors (e.g., return an error message)
                //     return new Response('Please fill in all required fields.', 400);
                //}

                // // Hash the password before storing it
                // $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // // Create a new User entity and set its properties
                // $user = new User();
                // $user->setFirstName($firstName);
                // $user->setLastName($lastName);
                // $user->setEmail($email);
                // $user->setPassword($hashedPassword);
                // $user->setAddress($address);
                // $user->setPostalCode($postalCode);
                // $user->setCity($city);
                // // Set other properties as needed

                // // Persist the user entity to the database
                // $entityManager = $this->getDoctrine()->getManager();
                // $entityManager->persist($user);
                // $entityManager->flush();

                // Redirect to a success page or login page after registration
                //return $this->redirectToRoute('app_login');
                // return $this->render('main/index.html.twig', [
                //         'controller_name' => 'RegisterController',
                //         'page' => 'main',
                //         'title' => 'home',
                //         'status' => 'online'
                // ]);
            }
            return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'page' => 'register',
            'title' => 'BasketShop - Register',
            'message' => '',
        ]);
    }

    

}
