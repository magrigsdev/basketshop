<?php 

namespace App\Services;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(private EntityManagerInterface $entity_manager,private  UserPasswordHasherInterface $password_hasher){}

    public function createUser(string $email, string $plainPassword): User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword($this->password_hasher->hashPassword($user, $plainPassword));


        $user->setRoles('ROLE_USER');
        $user->setAddress('14 Rue de la Paix');
        $user->setPostalCode('75002');
        $user->setCity('Paris');
        $user->setFirstName('John');
        $user->setLastName('Doe');

        $this->entity_manager->persist($user);
        $this->entity_manager->flush();
        
        return $user;

    }
}