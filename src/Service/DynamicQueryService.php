<?php 

namespace App\Service;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;
class DynamicQueryService 
{
    private Connection $connection;
    private LoggerInterface $logger;

    public function __construct(Connection $connection, LoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }


    public function findByEmail(string $table, string $email): ?array 
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
}