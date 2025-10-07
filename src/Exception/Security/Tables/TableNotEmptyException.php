<?php

namespace App\Exception\Security\Tables;

class TableNotEmptyException extends \InvalidArgumentException
{
    public function __construct(string $table)
    {
        parent::__construct(sprintf("The table '%s' name cannot be empty", $table));
    }
}
