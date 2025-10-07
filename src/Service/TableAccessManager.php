<?php

namespace App\Service;

use App\Exception\Security\Fields\FieldNotEmptyException;
use App\Exception\Security\Roles\RoleInvalidValueException;
use App\Exception\Security\Roles\RoleNotAllowedException;
use App\Exception\Security\Tables\TableNotAllowedException;
use App\Exception\Security\Tables\TableNotEmptyException;
use App\Logger\AppLogger;

class TableAccessManager
{
    private AppLogger $logger;
    private array $whiteList;
    private array $columnName;
    private array $roles;

    public function __construct(AppLogger $logger, array $whiteList, array $roles, array $columnName)
    {
        $this->logger = $logger;
        $this->whiteList = $whiteList;
        $this->roles = $roles;
        $this->columnName = $columnName;
    }

    /**
     * Determines if access to the specified table is allowed.
     *
     * @param string $table the name of the table to check access for
     *
     * @return bool true if access is allowed, false otherwise
     *
     * @throws TableNotEmptyException
     * @throws TableNotAllowedException
     */
    public function isAllowedtable(string $table): bool
    {
        if (empty(trim($table))) {
            throw new TableNotEmptyException($table);
        }

        if (!in_array($table, $this->whiteList, true)) {
            throw new TableNotAllowedException($table);
        }

        return true;
    }

    public function isRoles(string $role): bool
    {
        if (empty(is_string(trim($role)))) {
            throw new FieldNotEmptyException($role);
        }

        if (!is_string($role)) {
            throw new RoleInvalidValueException($role);
        }

        if (!in_array($role, $this->roles, true)) {
            throw new RoleNotAllowedException($role);
        }

        return true;
    }
}
