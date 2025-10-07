<?php

namespace App\Tests\Traits;

use App\Service\TableAccessManager;
use App\Traits\SimpleSearchTrait;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Result;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use RuntimeException;

class SimpleSearchTraitTest extends TestCase
{
    private const TABLE = 'user';
    private const EMAIL = 'test@example.com';
    private const ROLE = 'ROLE_USER';

    /**
     * Creates an anonymous class instance that uses the SimpleSearchTrait.
     *
     * @param Connection         $connection         the database connection instance
     * @param LoggerInterface    $logger             the logger instance for logging operations
     * @param TableAccessManager $tableAccessManager the table access manager for handling table operations
     *
     * @return object an instance of an anonymous class utilizing SimpleSearchTrait
     */
    private function createDummy(Connection $connection, LoggerInterface $logger, TableAccessManager $tableAccessManager)
    {
        return new class($connection, $logger, $tableAccessManager) {
            use SimpleSearchTrait;

            public function __construct(Connection $connection, LoggerInterface $logger, TableAccessManager $tableAccessManager)
            {
                $this->connection = $connection;
                $this->logger = $logger;
                $this->tableAccessManager = $tableAccessManager;
            }
        };
    }

    /**
     * Creates and returns an array of mock objects for unit testing.
     *
     * Mocks the following classes:
     * - Connection
     * - TableAccessManager
     * - Result
     * - QueryBuilder
     * - LoggerInterface
     *
     * @return array{
     *     connection: Connection,
     *     tableAccessManager: TableAccessManager,
     *     result: Result,
     *     queryBuilder: QueryBuilder,
     *     logger: LoggerInterface
     * }
     */
    private function createMocks(): array
    {
        return [
            'connection' => $this->createMock(Connection::class),
            'tableAccessManager' => $this->createMock(TableAccessManager::class),
            'result' => $this->createMock(Result::class),
            'queryBuilder' => $this->createMock(QueryBuilder::class),
            'logger' => $this->createMock(LoggerInterface::class),
        ];
    }

    private function configureQueryBuilder(QueryBuilder $queryBuilder, Result $result, string $table, string $email)
    {
        $queryBuilder->method('select')->with('*')->willReturnSelf();
        $queryBuilder->method('from')->with($table)->willReturnSelf();
        $queryBuilder->method('where')->with('email = :email')->willReturnSelf();
        $queryBuilder->method('setParameter')->with('email', $email)->willReturnSelf();
        $queryBuilder->method('setMaxResults')->with(1)->willReturnSelf();
        $queryBuilder->method('executeQuery')->willReturn($result);
    }

    private function createResult(QueryBuilder $queryBuilder, Result $result, string $table, string $value)
    {
        $queryBuilder->method('select')->with('*')->willReturnSelf();
        $queryBuilder->method('from')->with($table)->willReturnSelf();
        $queryBuilder->method('where')->with('role = :role')->willReturnSelf();
        $queryBuilder->method('setParameter')->with('role', $value)->willReturnSelf();
        $queryBuilder->method('setMaxresults')->with(1)->willReturnSelf();
        $queryBuilder->method('executeQuery')->willReturn($result);
    }

    // *******************  FIN PRIVATE FUNCTION */

    public function testFindByEmailReturnsRecord()
    {
        $expected = ['email' => self::EMAIL];

        $mocks = $this->createMocks();
        [
            'connection' => $connection,
            'tableAccessManager' => $tableAccessManager,
            'result' => $result,
            'queryBuilder' => $queryBuilder,
            'logger' => $logger,
        ] = $mocks;

        $tableAccessManager->expects($this->once())->method('isAllowedTable')->with(self::TABLE);
        $result->expects($this->once())->method('fetchAssociative')->willReturn($expected);

        $this->configureQueryBuilder($queryBuilder, $result, self::TABLE, self::EMAIL);

        $connection->method('quoteIdentifier')->willReturn(self::TABLE);
        $connection->method('createQueryBuilder')->willReturn($queryBuilder);

        $dummy = $this->createDummy($connection, $logger, $tableAccessManager);
        $this->assertSame($expected, $dummy->findByEmail(self::TABLE, self::EMAIL));
    }

    public function testFindByEmailReturnsNullWhenNotFound(): void
    {
        $mocks = $this->createMocks();
        [
            'connection' => $connection,
            'tableAccessManager' => $tableAccessManager,
            'result' => $result,
            'queryBuilder' => $queryBuilder,
            'logger' => $logger,
        ] = $mocks;

        $tableAccessManager->expects($this->once())->method('isAllowedTable')->with(self::TABLE);
        $result->expects($this->once())->method('fetchAssociative')->willReturn(false);
        $this->configureQueryBuilder($queryBuilder, $result, self::TABLE, self::EMAIL);

        $connection->method('quoteIdentifier')->willReturn(self::TABLE);
        $connection->method('createQueryBuilder')->willReturn($queryBuilder);
        $dummy = $this->createDummy($connection, $logger, $tableAccessManager);
        $this->assertNull($dummy->findByEmail(self::TABLE, self::EMAIL));
    }

    /**
     * Tests that the findByEmail method wraps a generic Exception thrown during query execution
     * in a RuntimeException with a specific error message.
     *
     * This test sets up mock objects for the database connection, table access manager,
     * query builder, and logger. It configures the query builder to throw a generic Exception
     * when executeQuery is called. The test then asserts that findByEmail throws a RuntimeException
     * with the expected message when a database error occurs.
     */
    public function testFindByEmailWrapsGenericExceptionInRuntimeException(): void
    {
        $mocks = $this->createMocks();
        [
            'connection' => $connection,
            'tableAccessManager' => $tableAccessManager,
            'result' => $result,
            'queryBuilder' => $queryBuilder,
            'logger' => $logger,
        ] = $mocks;

        $tableAccessManager->expects($this->once())
        ->method('isAllowedTable')->with(self::TABLE);
        $connection->method('quoteIdentifier')->willReturn(self::TABLE);

        $queryBuilder->method('select')->willReturnSelf();
        $queryBuilder->method('from')->willReturnSelf();
        $queryBuilder->method('where')->willReturnSelf();
        $queryBuilder->method('setParameter')->willReturnSelf();
        $queryBuilder->method('setMaxResults')->willReturnSelf();
        $queryBuilder->expects($this->once())
            ->method('executeQuery')->will($this->throwException(new \Exception('DB fail')));

        $connection->method('createQueryBuilder')->willReturn($queryBuilder);
        $dummy = $this->createDummy($connection, $logger, $tableAccessManager);
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('An error occurred while searching for the user.');
        $dummy->findByEmail(self::TABLE, self::EMAIL);
    }

    public function testFindRoleReturnRecord(): void
    {
        $expected = ['john', 'ROLE_USER'];    // code...
        $mocks = $this->createMocks();
        [
            'connection' => $connection,
            'tableAccessManager' => $tableAccessManager,
            'result' => $result,
            'queryBuilder' => $queryBuilder,
            'logger' => $logger,
        ] = $mocks;

        $tableAccessManager->expects($this->once())->method('isAllowedTable')->with(self::TABLE);
        $tableAccessManager->expects($this->once())->method('isRoles')->with(self::ROLE)->willReturn(true);

        $result->expects($this->once())->method('fetchAssociative')->willReturn($expected);

        $this->createResult($queryBuilder, $result, self::TABLE, self::ROLE);

        $connection->method('quoteIdentifier')->willReturn(self::TABLE);
        $connection->method('createQueryBuilder')->willReturn($queryBuilder);

        $dummy = $this->createDummy($connection, $logger, $tableAccessManager);
        $this->assertSame($expected, $dummy->findByRole(self::TABLE, self::ROLE));
    }
}
