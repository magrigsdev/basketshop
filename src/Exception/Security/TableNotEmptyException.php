<?php

namespace App\Exception\Security;

class TableNotEmptyException extends \InvalidArgumentException
{
    public function __construct(string $table)
    {
        $message = empty($table)
        ? 'The table name cannot be empty or invalid'
        : "The table name '$table' is invalid";
        parent::__construct($message);
    }
}
