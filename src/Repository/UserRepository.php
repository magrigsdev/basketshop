<?php

namespace App\Repository;

use Dom\Entity;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }
    public function save(User $user, bool $flush = false): void
    {
        if(!$user->getId()){
            do{
                $newId = $this->generateUserId();
            }while($this->IdExist($newId));
            $user->setId($newId);
            $this->getEntityManager()->persist($user);       
            if ($flush) {
                $this->getEntityManager()->flush();
            }
        }
           
    }
    protected function generateUserId(): string
    {
        return 'user'.bin2hex(random_bytes(5));
    }
    public function EmailIsExist(string $email):bool
    {
        $user = $this->findOneBy(['email'=>$email]);
        if($user){
            return true;
        }
        return false;
    }
    protected function IdExist(string $id):bool
    {
        $user = $this->find($id);
        if($user){
            return true;
        }
        return false;
    }
    public function remove(User $user, bool $flush = false): void
    {
        $this->getEntityManager()->remove($user);       
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   
}
