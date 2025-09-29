<?php

namespace App\Service;

use App\Logger\AppLogger;
use App\Exception\Security\FieldNotEmptyException;
use App\Exception\Security\TableNotEmptyException;
use App\Exception\Security\RoleNotAllowedException;
use App\Exception\Security\TableNotAllowedException;

class TableAccessManager
{
    private AppLogger $logger;
    private array $whiteList;
    private array $columnName;
    private array $roles;
    private bool $isDevEnvironement;
   

    public function __construct(AppLogger $logger, array $whiteList, bool $isDevEnvironement, $roles , $columnName)
    {
        $this->logger = $logger;
        $this->whiteList = $whiteList;
        $this->isDevEnvironement = $isDevEnvironement;
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

    public function isRoles(array $role): bool
    {
        $role = $role[0];
        if (empty(trim($role[0]))) {
            throw new FieldNotEmptyException($role);
        }

        if (!in_array($role, $this->roles, true)) {         
            throw new RoleNotAllowedException($role);
        }
        return true;
    }
}
