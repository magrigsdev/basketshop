<?php

namespace App\Exception\Validation\Name;

class InvalidTypeNameException extends \InvalidArgumentException
{
    public function __construct(string $typeOfName, ?\Throwable $previous = null)
    {
        $message = "Invalid type of name '%s' {$typeOfName}'.";
        parent::__construct($message, 400, $previous);
    }
}
