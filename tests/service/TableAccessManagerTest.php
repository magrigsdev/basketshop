<?php

namespace Tests\Service;

use App\Exception\Security\RoleNotAllowedException;
use App\Exception\Security\TableNotAllowedException;
use App\Exception\Security\TableNotEmptyException;
use App\Logger\AppLogger;
use App\Service\TableAccessManager;
use PHPUnit\Framework\TestCase;

class TableAccessManagerTest extends TestCase
{
    private AppLogger $loggerMock;
    private TableAccessManager $tableAccessManager;
    private array $columnName = [];

    protected function setUp(): void
    {
        $this->loggerMock = $this->createMock(AppLogger::class);
        $whiteList = ['user', 'products'];
        $roles = ['ROLE_USER', 'ROLE_ADMIN'];
        $columnName = ['name'];

        $this->tableAccessManager = new TableAccessManager(
            $this->loggerMock,
            $whiteList,
            $roles,
            $columnName
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

    // ****************** ROLE TEST */

    public function testIsRolesAllowsWithRoleNotValidException(): void
    {
        $this->expectException(RoleNotAllowedException::class);
        $this->tableAccessManager->isRoles(['ROLE_UNKOWN']);
    }

    public function testIsRolesAllowsWithRoleValid(): void
    {
        $roleValid = $this->tableAccessManager->isRoles(['ROLE_USER']);
        $this->assertTrue($roleValid);
    }
}
