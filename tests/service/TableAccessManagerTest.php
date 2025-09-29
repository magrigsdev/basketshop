<?php

namespace Tests\Service;

use App\Exception\Security\TableNotAllowedException;
use App\Exception\Security\TableNotEmptyException;
use App\Logger\AppLogger;
use App\Service\TableAccessManager;
use PHPUnit\Framework\TestCase;

class TableAccessManagerTest extends TestCase
{
    private AppLogger $loggerMock;
    private TableAccessManager $tableAccessManager;

    protected function setUp(): void
    {
        $this->loggerMock = $this->createMock(AppLogger::class);
        $whiteList = ['user', 'products'];
        $this->tableAccessManager = new TableAccessManager(
            $this->loggerMock,
            $whiteList,
            isDevEnvironement: true
        );
    }

    public function testIsAllowedTableWithValidTable()
    {
        $this->assertTrue($this->tableAccessManager->isAllowedtable('user'));
    }

    public function testIsAllowedTableWithEmptyTable()
    {
        $this->expectException(TableNotEmptyException::class);
        $this->tableAccessManager->isAllowedtable('');
    }

    public function testIsAllowedTableWithNonWhitelistedTable()
    {
        $this->expectException(TableNotAllowedException::class);
        $this->tableAccessManager->isAllowedtable('forbidden_table');
    }
}
