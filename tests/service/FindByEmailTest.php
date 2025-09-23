<?php
// tests/Service/DynamicQueryServiceTest.php
namespace App\Tests\Service;

use App\Service\DynamicQueryService;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Result;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class FindByEmailTest extends TestCase
{
    private DynamicQueryService $dynamicQueryService;
    private LoggerInterface $logger;
    private Connection $connection;

    private Result $result;

    protected function setUp(): void
    {
        // Initialisation du logger (mock)
        $this->logger = $this->createMock(LoggerInterface::class);
        // Configuration des mocks
        $this->connection = $this->createMock(Connection::class);

        // Initialisation de la connexion (mock)
        $this->connection = $this->createMock(Connection::class);

        // Initialisation du service à tester
        $this->dynamicQueryService = new DynamicQueryService($this->connection, $this->logger);
    }

    private function mocksConfig():object
    {
        //creation 
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $this->result = $this->createMock(Result::class);

        $this->connection->method('createQueryBuilder')->willReturn($queryBuilder);

        $queryBuilder->method('select')->with('*')->willReturn($queryBuilder);
        $queryBuilder->method('from')->with($this->anything())->willReturn($queryBuilder);
        $queryBuilder->method('where')->with($this->anything())->willReturn($queryBuilder);
        $queryBuilder->method('setParameter')->with($this->anything(), $this->anything())
            ->willReturn($queryBuilder);
        $queryBuilder->method('setMaxResults') ->with(1)
            ->willReturn($queryBuilder);
        $queryBuilder ->method('executeQuery') ->willReturn($this->result);

        return $queryBuilder;
    }

    /**
     *  @doesNotPerformAssertions
    */
    public function testFindByEmailFoundReturnResult(): void
    {       
        $queryBuilder = $this->mocksConfig();
        $this->result->method('fetchAssociative')->willReturn(['email' => 'test@example.com']);
        $res = $this->dynamicQueryService->findByEmail('user', 'test@example.com');
        // Assertion
        $this->assertEquals(['email' => 'test@example.com'], $res);
    }

    
    public function testFindByEmailNoFoundReturnNull(): void
    { 
        $queryBuilder = $this->mocksConfig();
        $queryBuilder ->method('executeQuery') ->willReturn($this->result);
        $this->result ->method('fetchAssociative')->willReturn(false);

        // Exécution
        $res = $this->dynamicQueryService->findByEmail('user', 'null@example.com');

        // Assertion
        $this->assertNull($res);
    }

}
