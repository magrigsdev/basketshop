<?php

namespace App\Exception\Security;

class FieldNotEmptyException extends \InvalidArgumentException
{
    public function __construct(string $field)
    {
        parent::__construct(sprintf("The field '%s' cannot be empty", $field));
    }
}
