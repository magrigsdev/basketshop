<?php 

namespace App\Tests\Users;

use App\Kernel;
use Dom\Entity;
use App\Entity\User;
use App\Services\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserInsertionTest extends KernelTestCase
{
    public function testUserInsertion(): void
    {
        self::bootkernel();
        $container = self::$kernel->getContainer();
        
        $user_service = $container->get(UserService::class);
        
            

    }
}