<?php

namespace App\Exception\Validation\Name;

class InvalidNameFormatException extends \InvalidArgumentException
{
    public function __construct(string $fieldName, ?\Throwable $previous = null)
    {
        $message = "Invalid format of field '{$fieldName}'.";
        parent::__construct($message, 400, $previous);
    }
}
