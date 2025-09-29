<?php

namespace App\Traits;

use App\Exception\Security\TableNotAllowedException;
use App\Exception\Security\TableNotEmptyException;
use App\Exception\Validation\Name\EmptyNameException;
use App\Exception\Validation\Name\InvalidNameFormatException;
use App\Service\NameValidationService;
use App\Service\TableAccessManager;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

trait SimpleSearchTrait
{
    private Connection $connection;
    private LoggerInterface $logger;
    private TableAccessManager $tableAccessManager;

    private NameValidationService $nameValidationService;

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
            $this->logger->error(sprintf("access denied for table '%s'", $table));
            throw new \RuntimeException(sprintf("The table '%s' is not accessible.", $table), 0, $e);

        } catch (TableNotEmptyException $e) {
            throw new \RuntimeException(sprintf("The table '%s' is empty ", $table), 0, $e);

        } catch (\Exception $e) {
            $this->logger->error("An error occurred while searching for the user.", 
            ['exception' => $e, 'table' => $table, 'email' => $email]);
            throw new \RuntimeException('An error occurred while searching for the user.', 0, $e);
        }
    }

    public function findByUsername()
    {
    }

    /**
     * Finds a record by first or last name in the specified table.
     *
     * Validates the name according to the type (first or last), checks table access permissions,
     * and performs a query to find a matching record. Returns the found record as an associative array,
     * or null if no match is found.
     *
     * @param string $table      the name of the table to search in
     * @param string $name       the name value to search for
     * @param string $typeOfName the type of name to search by ('first' or 'last')
     *
     * @return array|null the found record as an associative array, or null if not found
     *
     * @throws \RuntimeException if the table does not exist, is empty, the name is empty or invalid,
     *                           or another error occurs during the search
     */
    public function findByName(string $table, string $name, string $typeOfName): ?array
    {
        $searchMap =
        [
            'first' => 'firstName',
            'last' => 'lastName',
        ];

        $columnName = $searchMap[strtolower($typeOfName)] ?? null;
        if (null === $columnName) {
            throw new \InvalidArgumentException(sprintf("Invalid type of name '%s'. Must be 'first' or 'last'", $typeOfName));
        }

        // CONDITIONS
        if ('firstName' === $columnName) {
            $this->nameValidationService->validateFirstName($name);
        } else {
            $this->nameValidationService->validateLastName($name);
        }

        $this->tableAccessManager->isAllowedtable($table);
        try {
            $queryBuilder = $this->connection->createQueryBuilder();
            $queryBuilder
                ->select('*')
                ->from($this->connection->quoteIdentifier($table))
                ->where(sprintf('%s = :nameValue', $columnName))
                ->setParameter('nameValue', $name)
                ->setMaxResults(1);
            $result = $queryBuilder->executeQuery()->fetchAssociative();

            return false !== $result ? $result : null;
        }

        // CATCH FOR TABLE ******************************

        catch (TableNotAllowedException $e) {
            // throw $th;
            throw new \RuntimeException(sprintf("The table '%s' does not exist ", $table), 0, $e);
        } catch (TableNotEmptyException $e) {
            throw new \RuntimeException(sprintf("The table '%s' is empty ", $table), 0, $e);
        } catch (\Exception $e) {
            throw new \RuntimeException('An error occurred while searching for the user.', 0, $e);
        }
        // CATCH FOR NAME ******************************

        catch (EmptyNameException $e) {
            throw new \RuntimeException('An error occurred the field is empty.', 0, $e);
        } catch (InvalidNameFormatException $e) {
            throw new \RuntimeException('An error occurred the name is invald.', 0, $e);
        }
    }

    public function findByStatus()
    {
    }

    public function findByRole()
    {
    }
}
