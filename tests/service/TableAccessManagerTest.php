<?php 

namespace Tests\Service;

use App\Logger\AppLogger;
use PHPUnit\Framework\TestCase;
use App\Service\TableAccessManager;
use App\Exception\Security\TableNotAllowedException;
use App\Exception\Security\TableNotEmptyException;

class TableAccessManagerTest extends TestCase
{
    private AppLogger $loggerMock;
    private TableAccessManager $tableAccessManager;

    protected function setUp(): void
    {
        $this->loggerMock = $this->createMock(AppLogger::class);
        $whiteList = ['user','products'];
        $this->tableAccessManager = new TableAccessManager(
            $this->loggerMock,
            $whiteList,
            true
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