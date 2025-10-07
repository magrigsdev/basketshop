<?php

namespace App\Exception\Security\Roles;

class RoleInvalidValueException extends \RuntimeException
{
    public function __construct(string $role)
    {
        $message = 'Invalid role value '.$role;
        parent::__construct($message);
    }
}
