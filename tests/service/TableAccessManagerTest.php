<?php

namespace Tests\Service;

use App\Exception\Security\Roles\RoleNotAllowedException;
use App\Exception\Security\Tables\TableNotAllowedException;
use App\Exception\Security\Tables\TableNotEmptyException;
use App\Logger\AppLogger;
use App\Service\TableAccessManager;
use PHPUnit\Framework\TestCase;

class TableAccessManagerTest extends TestCase
{
    private AppLogger $loggerMock;
    private TableAccessManager $tableAccessManager;
    private array $columnName = [];
    private $roles = ['ROLE_USER', 'ROLE_ADMIN'];

    protected function setUp(): void
    {
        $this->loggerMock = $this->createMock(AppLogger::class);
        $whiteList = ['user', 'products'];

        $columnName = ['name'];

        $this->tableAccessManager = new TableAccessManager(
            $this->loggerMock,
            $whiteList,
            $this->roles,
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

    /**
     * Tests that the isRoles method throws a RoleNotAllowedException
     * when an invalid role is provided.
     */
    public function testIsRolesAllowsWithRoleNotValidException(): void
    {
        $this->expectException(RoleNotAllowedException::class);
        $this->tableAccessManager->isRoles('ROLE_UNKOWN');
    }

    public function testIsRolesAllowsWithRoleValid(): void
    {
        $roleValid = $this->tableAccessManager->isRoles($this->roles[0]);
        $this->assertTrue($roleValid);
    }
}
