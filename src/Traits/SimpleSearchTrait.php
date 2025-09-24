<?php 

namespace App\Traits;

use Psr\Log\LoggerInterface;
use Doctrine\DBAL\Connection;
use App\Exception\Security\TableNotAllowedException;
use App\Exception\Security\TableNotEmptyOrInvalidException;


Trait SimpleSearchTrait
{
    private Connection $connection;
    private LoggerInterface $logger;

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }
    public function findByEmail(string $table, string $email):?array 
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder
        ->select('*')
        ->from($this->connection->quoteIdentifier($table))
        ->where('email = :email')
        ->setParameter('email', $email)
        ->setMaxResults(1);
        $result = $queryBuilder->executeQuery()->fetchAssociative();
        return $result !== false ? $result : null;
    }

    public function findByUsername(){}
    public function findByStatus(){}
    public function findByRole(){}




    // protected function isAllowedTable(string $table):mixed
    // {
    //      if (empty(trim($table))) {
    //         throw new TableNotEmptyOrInvalidException("The table name is required and cannot be empty.");
    //     }

    //     if(!in_array($table, $this->WhiteList, true))
    //     {
    //         throw new TableNotAllowedException($table);
    //     }
    //     return true;
    // }  
}