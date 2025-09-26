<?php

namespace App\Exception\Validation\Name;

class EmptyNameException extends \InvalidArgumentException
{
    public function __construct(string $fieldName, ?\Throwable $previous = null)
    {
        $message = "The name '{$fieldName}' cannot be empty or invalid.";
        parent::__construct($message, 400, $previous);
    }
}
