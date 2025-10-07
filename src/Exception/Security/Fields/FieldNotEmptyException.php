<?php

namespace App\Exception\Security\Fields;

class FieldNotEmptyException extends \InvalidArgumentException
{
    public function __construct(mixed $field)
    {
        parent::__construct(sprintf("The field '%s' cannot be empty", $field));
    }
}
