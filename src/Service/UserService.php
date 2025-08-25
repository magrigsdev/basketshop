<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class UserService
{
    private UserRepository $user_repository;
    private PasswordAuthenticatedUserInterface $paui;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function generateUserId(): string
    {
        return 'user'.bin2hex(random_bytes(5));
    }

    public function createUser(string $email, string $plainPassword, array $roles, string $firstName, string $lastName,
        string $address, string $postalcode, string $city): ?User
    {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword(password_hash($plainPassword, PASSWORD_BCRYPT));
        $user->setRoles($roles);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setAddress($address);
        $user->setPostalCode($postalcode);
        $user->setCity($city);

        do {
            $newId = $this->generateUserId();
        } while (null !== $this->user_repository->find($newId));

        $user->setId($newId);

        if ($this->user_repository->EmailIsExist($email)) {
            return null;
        }

        return $user;
    }

    public function password_is_valid($password, $hashed_password): bool
    {
        return password_verify($password, $hashed_password) ? true : false;
    }
}
