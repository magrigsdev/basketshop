<?php

namespace App\Traits;

trait RepositoryUtilsTrait
{
    /**
     * Summary of getIdByField.
     *
     * @param mixed $value
     *                     return le ID d'une entité par champ
     */
    public function getIdByField(string $field, mixed $value): ?int
    {
        $entity = $this->findOnBy([$field => $value]);

        return $entity ? $entity->getId() : null;
    }

    /**
     * Summary of existsByField.
     *
     * @return bool
     *              vérifié si une valeur existe déjà pour ce champ
     */
    public function existsByField(string $field, mixed $value): bool
    {
        return null !== $this->findOnBy([$field => $value]);
    }

    /**
     * Summary of getCount
     * retourne le nombre total d'enregistrement.
     */
    public function getCount(): int
    {
        return $this->count([]);
    }

    public function updateField(object $entity, string $field, mixed $value): void
    {
        $setter = 'set'.ucfirst($field);
        if (method_exists($entity, $setter)) {
            $entity->$setter($value);
        }
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

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
     * Retourne l'ID d'une entité selon un champ donné.
     *
     * @param string $field Nom du champ ('name', 'type', 'libelle', etc.)
     * @param mixed  $value Valeur à chercher
     */
    public function getIdByName(string $field, mixed $value): mixed
    {
        $entity = $this->findOneBy([$field => $value]);

        return $entity !== null ? $entity : null;
    }
}
