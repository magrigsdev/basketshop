<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    private UserRepository $user_repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->user_repository = self::getContainer()->get(UserRepository::class);
    }
}
