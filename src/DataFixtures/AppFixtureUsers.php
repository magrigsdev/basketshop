<?php

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtureUsers extends Fixture
{
    private UserRepository $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->$user_repository = $user_repository;
    }

    public function load(ObjectManager $manager): void
    {
        $users =
        [
            // --- Admins ---
            [
                'id' => 'admin001',
                'email' => 'admin1@example.com',
                'password' => 'adminpass1', // 🔐 should be hashed in fixtures
                'firstName' => 'Alice',
                'lastName' => 'Dupont',
                'address' => '10 Rue de Lyon',
                'postalCode' => '69001',
                'city' => 'Lyon',
                'roles' => ['ROLE_ADMIN'],
            ],
            [
                'id' => 'admin002',
                'email' => 'admin2@example.com',
                'password' => 'adminpass2',
                'firstName' => 'Marc',
                'lastName' => 'Durand',
                'address' => '25 Avenue Victor Hugo',
                'postalCode' => '75016',
                'city' => 'Paris',
                'roles' => ['ROLE_ADMIN'],
            ],

            // --- Users ---
            [
                'id' => 'user0001',
                'email' => 'user1@example.com',
                'password' => 'password1',
                'firstName' => 'Sophie',
                'lastName' => 'Martin',
                'address' => '12 Rue des Lilas',
                'postalCode' => '75001',
                'city' => 'Paris',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0002',
                'email' => 'user2@example.com',
                'password' => 'password2',
                'firstName' => 'Lucas',
                'lastName' => 'Bernard',
                'address' => '45 Boulevard Saint-Michel',
                'postalCode' => '75005',
                'city' => 'Paris',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0003',
                'email' => 'user3@example.com',
                'password' => 'password3',
                'firstName' => 'Emma',
                'lastName' => 'Petit',
                'address' => '30 Rue de la République',
                'postalCode' => '69002',
                'city' => 'Lyon',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0004',
                'email' => 'user4@example.com',
                'password' => 'password4',
                'firstName' => 'Noah',
                'lastName' => 'Lefevre',
                'address' => '5 Avenue de la Gare',
                'postalCode' => '31000',
                'city' => 'Toulouse',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0005',
                'email' => 'user5@example.com',
                'password' => 'password5',
                'firstName' => 'Clara',
                'lastName' => 'Roux',
                'address' => '90 Rue Nationale',
                'postalCode' => '59800',
                'city' => 'Lille',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0006',
                'email' => 'user6@example.com',
                'password' => 'password6',
                'firstName' => 'Hugo',
                'lastName' => 'Moreau',
                'address' => '15 Rue des Fleurs',
                'postalCode' => '44000',
                'city' => 'Nantes',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0007',
                'email' => 'user7@example.com',
                'password' => 'password7',
                'firstName' => 'Léa',
                'lastName' => 'Girard',
                'address' => '70 Avenue Jean Jaurès',
                'postalCode' => '13008',
                'city' => 'Marseille',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0008',
                'email' => 'user8@example.com',
                'password' => 'password8',
                'firstName' => 'Gabriel',
                'lastName' => 'Fournier',
                'address' => '8 Rue Victor Hugo',
                'postalCode' => '21000',
                'city' => 'Dijon',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0009',
                'email' => 'user9@example.com',
                'password' => 'password9',
                'firstName' => 'Chloé',
                'lastName' => 'Lopez',
                'address' => '3 Allée des Acacias',
                'postalCode' => '33000',
                'city' => 'Bordeaux',
                'roles' => ['ROLE_USER'],
            ],
            [
                'id' => 'user0010',
                'email' => 'user10@example.com',
                'password' => 'password10',
                'firstName' => 'Nathan',
                'lastName' => 'David',
                'address' => '50 Rue du Port',
                'postalCode' => '14000',
                'city' => 'Caen',
                'roles' => ['ROLE_USER'],
            ],
        ];

        foreach ($users as [$id, $email, $password, $firstName, $lastName, $address, $postalCode,$city,$roles]) {
            $user = new User();
            $user->setId($id)
                ->setEmail($email)
                ->setPassword($this->user_repository->hashPassword($password))
                ->setFirstName($firstName)
                ->setLastName($lastName)
                ->setAddress($address)
                ->setPostalCode($postalCode)
                ->setCity($city)
                ->setRoles($roles);
            $manager->persist($user);
        }
        $manager->flush();
    }
}
