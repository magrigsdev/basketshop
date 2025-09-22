<?php

namespace App\Traits;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

trait  RepositoryHelpersTrait
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * Returns the record count.
     */
    public function getCount(): int
    {
        return $this->count([]);
    }

    /**
     * Retrieves all records in an array format.
     */
    public function getAll(): array
    {
        return $this->findAll();
    }

    
    /**
     * Returns the ID of an entity based on a given field.
     *
     * @param string $field The field name ('name', 'type', 'label', etc.)
     * @param mixed  $value The value to search for
     *
     * @return int|null The entity ID if found, or null if no match exists
     */
    public function getIdByName(string $field, mixed $value): mixed
    {
        $entity = $this->findOneBy([$field => $value]);

        return null !== $entity ? $entity : null;
    }

    /**
     * @param array $criteria key-value pairs to search
     *
     * @return bool True if a record exist, false otherwise
     */
    public function recordExists(array $criteria): bool
    {
        $entity = $this->findOneBy($criteria);

        return null !== $entity;
    }

    public function hashPassword($password): string
    {
        return $this->passwordHasher->hashPassword($this, $password);
    }

    public function isPasswordValid(string $password): bool
    {
        return $this->passwordHasher->isPasswordValid($this, $password);
    }

    //recherche simple et personnaliser
    public function findByEmail(string $email)
    {
        
    }
}
