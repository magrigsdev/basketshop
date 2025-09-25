<?php

namespace Tests\Traits;

use App\Exception\Security\TableNotAllowedException;
use App\Service\TableAccessManager;
use App\Traits\SimpleSearchTrait;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Result;
use PHPUnit\Framework\TestCase;

class FindByEmailTest extends TestCase
{
    use SimpleSearchTrait;
    private $tableAccessManagerMock;
    private Connection $connectionMock;
    private $queryBuilderMock;
    private $ResultMock;

    protected function setUp(): void
    {
        $this->connectionMock = $this->createMock(Connection::class);
        $this->queryBuilderMock = $this->createMock(QueryBuilder::class);
        $this->tableAccessManagerMock = $this->createMock(TableAccessManager::class);
        $this->ResultMock = $this->createMock(Result::class);
    }

    public function testFindByEmailWithUnauthoriziedTable(): void
    {
        $this->expectException(TableNotAllowedException::class);
        $this->tableAccessManagerMock->method('isAllowedTable')
            ->with('forbidden_table')
            ->willThrowException(new TableNotAllowedException('forbidden_table'));

        $this->findByEmail('forbidden_table', 'test@example.com');
    }
}
