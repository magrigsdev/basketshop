<?php

namespace App\Utils;

use App\Service\TableAccessManager;
use App\Traits\SimpleSearchTrait;
use Doctrine\DBAL\Connection;
use Psr\Log\LoggerInterface;

class SimpleSearchTraitWrapper
{
    use SimpleSearchTrait;

    public function __construct(Connection $connection, LoggerInterface $logger, TableAccessManager $tableAccessManager)
    {
        $this->connection = $connection;
        $this->logger = $logger;
        $this->tableAccessManager = $tableAccessManager;
    }
}
