<?php

namespace App\Service;

use Doctrine\Persistence\ObjectRepository;

class GlobalService
{
    /**
     * Compare les données avec l'entité existante et crée ou met à jour si nécessaire.
     *
     * @param array            $criteria   Champs pour chercher l'entité existante ['field' => 'value']
     * @param ObjectRepository $repository Repository de l'entité
     *
     * @return bool true si créé ou mis à jour, false si rien à changer
     */
    public function importUnique(
        array $criteria,
        ObjectRepository $repository,
    ): bool {
        foreach ($criteria as $field => $value) {
            $existing = $repository->findOneBy([$field => $value]);
            if (null !== $existing) {
                return true;
            }
        }

        return false;
    }

    public function tableCount($repository): int
    {
        return $repository->getCount([]);
    }
}
