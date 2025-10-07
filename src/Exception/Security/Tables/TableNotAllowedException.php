<?php

namespace App\Exception\Security\Tables;

class TableNotAllowedException extends \RuntimeException
{
    public function __construct(string $table)
    {
        parent::__construct(sprintf('The table "%s" is not allowed', $table));
    }
}
