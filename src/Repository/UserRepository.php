<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    
    private PasswordAuthenticatedUserInterface $paui;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function EmailIsExist(string $email): bool
    {
        $user = $this->findOneBy(['email' => $email]);
        if ($user) {
            return true;
        }

        return false;
    }

    public function save(User $user, bool $flush = false): bool
    {
        $this->getEntityManager()->persist($user);
        if ($flush) {
            $this->getEntityManager()->flush();

            return true;
        }

        return false;
    }
}
