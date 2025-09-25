<?php

namespace App\Service;

use App\Exception\Security\TableNotAllowedException;
use App\Exception\Security\TableNotEmptyException;
use App\Logger\AppLogger;

class TableAccessManager
{
    private AppLogger $logger;
    private array $whiteList;
    private bool $isDevEnvironement;

    public function __construct(AppLogger $logger, array $whiteList, bool $isDevEnvironement)
    {
        $this->logger = $logger;
        $this->whiteList = $whiteList;
        $this->isDevEnvironement = $isDevEnvironement;
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
            $message = 'The speficied table name is either empty or invalid';
            $this->logger->error($message, ['table' => $table]);
            throw new TableNotEmptyException($this->isDevEnvironement ? $message : 'Access denied.');
        }

        if (!in_array($table, $this->whiteList, true)) {
            $message = sprintf("The specified table '%s' is not authorized.", $table);
            $this->logger->error($message, ['table' => $table]);
            throw new TableNotAllowedException($this->isDevEnvironement ? $message : 'Access denied.');
        }

        return true;
    }
}
