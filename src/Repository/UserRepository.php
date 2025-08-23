<?php

namespace App\Repository;

use App\Entity\User;
use App\Service\UserService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    private UserPasswordHasherInterface $user_password_hasher_interface;
    private PasswordAuthenticatedUserInterface $paui;
    private UserService $user_service;

    public function __construct(ManagerRegistry $registry, UserPasswordHasherInterface $userPasswordHasher)
    {
        parent::__construct($registry, User::class);
        $this->user_password_hasher_interface = $userPasswordHasher;
    }

    public function EmailIsExist(string $email): bool
    {
        $user = $this->findOneBy(['email' => $email]);
        if ($user) {
            return true;
        }

        return false;
    }

    public function save(User $user, bool $flush = false): void
    {
        $this->getEntityManager()->persist($user);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
