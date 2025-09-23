<?php

namespace App\Traits;

use App\Exception\TableNotAllowedException;
use App\Service\DynamicQueryService;
use App\Service\EmailValidator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

trait  RepositoryHelpersTrait
{
    use DateSearchTrait;
    use JoinSearchTrait;
    use SimpleSearchTrait;
    use SoftDeleteTrait;
    use UserFilteredTrait;
    use StatsTrait;
    use UserFilteredTrait;

    private EmailValidator $email_validator;
    private DynamicQueryService $dynamic_query;
    private UserPasswordHasherInterface $passwordHasher;
    private array $White_list = ['user','category','products','visit'];

    // ****************  PROTECTED FUNCTIONS ****************************
     /**
     * Retourne une exception si la table n'existe pas.
     */
    protected function isAllowedTable(string $table):mixed
    {
         if (empty(trim($table))) {
            throw new \InvalidArgumentException("Le nom de table ne peut pas être vide.");
        }

        if(!in_array($table, $this->White_list, true))
        {
            throw new TableNotAllowedException("Table $table non autorisée.");
        }
        return true;
    }
    // ********************* PROTECTED FUNCTIONS **************************

    /**
     * Returns the record count.
     * @return int the total of records for this entity
     */
    public function getCount(): int
    {
        return $this->count([]);
    }

    /**
     * Retrieves all records in an array format.
     */
    public function getAll(): mixed
    {
        $result =  $this->findAll();
        return $result ?? null;
    }
 
    /**
     * Returns the ID of an entity based on a given field.
     *
     * @param string $field The field name ('name', 'type', 'label', etc.)
     * @param mixed  $value The value to search for
     *
     * @return int|null The entity ID if found, or null if no match exists
     */
    public function findIdByName(string $field, mixed $value): mixed
    {
        $entity = $this->findOneBy([$field => $value]);

        return null !== $entity ? $entity : null;
    }

    //recherche simple et personnaliser
    public function findByEmail(string $table, string $email):mixed
    {
        if(!$this->isAllowedTable($table))
        {
            throw new TableNotAllowedException($table);
        }
        $this->email_validator->validate($email);

        return $this->dynamic_query->findByEmail($table,$email);
    }

     // /**
    //  * @param array $criteria key-value pairs to search
    //  *
    //  * @return bool True if a record exist, false otherwise
    //  */
    // public function recordExists(array $criteria): bool
    // {
    //     $entity = $this->findOneBy($criteria);

    //     return null !== $entity;
    // }

    // public function hashPassword($password): string
    // {
    //     return $this->passwordHasher->hashPassword($this, $password);
    // }

    // public function isPasswordValid(string $password): bool
    // {
    //     return $this->passwordHasher->isPasswordValid($this, $password);
    // }
}
