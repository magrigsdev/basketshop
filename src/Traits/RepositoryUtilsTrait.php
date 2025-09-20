<?php

namespace App\Traits;

trait RepositoryUtilsTrait
{
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
     * Persists the given entity to the database.
     *
     * @param object $entity the entity instance to be saved
     * @param bool   $flush  whether to immediately flush changes to the database
     *
     * @return bool returns true if the entity was flushed, false otherwise
     */
    public function save(object $entity, bool $flush = false): bool
    {
        $this->getEntityManager()->persist($entity);
        if ($flush) {
            $this->getEntityManager()->flush();

            return true;
        }

        return false;
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
}
