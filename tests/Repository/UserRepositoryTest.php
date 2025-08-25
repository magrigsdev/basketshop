<?php

namespace App\Tests\Repository;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
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
        $user->setEmail('test8@example.com');
        $user->setPassword('password123');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstName('John');
        $user->setLastName('Doe');
        $user->setAddress('14 Rue de la Paix');
        $user->setPostalCode('75002');
        $user->setCity('Paris');

        $user_service = new UserService($this->user_repository);

        $user_created = $user_service->createUser(
            $user->getEmail(),
            $user->getPassword(),
            $user->getRoles(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getAddress(),
            $user->getPostalCode(),
            $user->getCity()
        );
        if (is_null($user_created)) {
            $this->assertNotNull($user_created, 'User with this email : '.$user->getEmail().' already exists.');
        }
        $saved_user = $this->user_repository->save($user_created, true);
        $this->assertTrue($saved_user);
        $this->assertNotNull($user_created->getId());
    }
}
