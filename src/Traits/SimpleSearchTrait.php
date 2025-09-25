<?php

namespace App\Traits;

use App\Exception\Security\TableNotAllowedException;
use App\Exception\Security\TableNotEmptyException;
use App\Service\TableAccessManager;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

trait SimpleSearchTrait
{
    private Connection $connection;
    private LoggerInterface $logger;
    private TableAccessManager $tableAccessManager;

    /**
     * Finds a single record by email from the specified table.
     *
     * Checks if access to the given table is allowed, then executes a query to fetch
     * the first record where the 'email' column matches the provided email address.
     *
     * @param string $table the name of the table to search in
     * @param string $email the email address to search for
     *
     * @return array|null the associative array of the found record, or null if not found or access is denied
     *
     * @throws TableNotAllowedException if table is not authorieizd
     * @throws TableNotEmptyException   if table is empty
     * @throws \RuntimeException        error inside database
     */
    public function findByEmail(string $table, string $email): ?array
    {
        $this->tableAccessManager->isAllowedtable($table);
        try {
            // code...
            $queryBuilder = $this->connection->createQueryBuilder();
            $queryBuilder
            ->select('*')
            ->from($this->connection->quoteIdentifier($table))
            ->where('email = :email')
            ->setParameter('email', $email)
            ->setMaxResults(1);
            $result = $queryBuilder->executeQuery()->fetchAssociative();

            return false !== $result ? $result : null;
        } catch (TableNotAllowedException $e) {
            // throw $th;
            throw new \RuntimeException(sprintf("The table '%s' does not exist ", $table), 0, $e);
        } catch (TableNotEmptyException $e) {
            throw new \RuntimeException(sprintf("The table '%s' is empty ", $table), 0, $e);
        } catch (\Exception $e) {
            throw new \RuntimeException('An error occurred while searching for the user.', 0, $e);
        }
    }

    public function findByUsername()
    {
    }

    public function findByStatus()
    {
    }

    public function findByRole()
    {
    }
}
