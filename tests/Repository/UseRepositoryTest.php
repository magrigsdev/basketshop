<?php 
namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase; 

class UseRepositoryTest extends KernelTestCase
{
    private UserRepository $user_repository;
    protected function setUp(): void
    {
        self::bootKernel();
        $this->user_repository = self::getContainer()->get(UserRepository::class);
    }
    public function testInsertUser(): void
    {
        $user = new User();
        $user->setEmail('test2@example.com');
        $user->setPassword('password123'); 
        $user->setRoles(['ROLE_USER']);
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setAddress('14 Rue de la Paix');
        $user->setPostalCode('75002');
        $user->setCity('Paris');

        if($this->user_repository->EmailIsExist($user->getEmail()))
        {
            $this->assertNotNull($user->getId(),
            'User with this email already exists.');     
        }
        else{
            $this->user_repository->save($user, true);
            $this->assertNotNull($user->getId());
        }    
    }


}