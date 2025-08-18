<?php 

namespace App\Tests\Users;

use App\Kernel;
use Dom\Entity;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserInsertionTest extends KernelTestCase
{
    public function testUserInsertion(): void
    {
        self::bootkernel();
        $container = self::$kernel->getContainer();
        $enttity_manager = $container->get('doctrine')->getManager();
        

        $user = new User();
        $user->setAddress('123 Main St');
        $user->setEmail('dotp@hotmail.com');
    
        $user->setRoles('ROLE_USER');
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setPostalCode('12345');
        $user->setCity('Anytown');

        $password_hasher_factory = $container->get('security.password_hasher_factory');
        $password_hasher = $password_hasher_factory->getPasswordHasher(User::class);
        $password_hasher = $password_hasher->hash('password123');
        $user->setPassword($password_hasher);

        $enttity_manager->persist($user);
        $enttity_manager->flush();
        $this->assertNotNull($user->getId(), 'User ID should not be null after insertion');
        
        
    }
}