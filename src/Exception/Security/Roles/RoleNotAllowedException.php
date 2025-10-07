<?php

namespace App\Exception\Security\Roles;

class RoleNotAllowedException extends \RuntimeException
{
    public function __construct(string $role)
    {
        parent::__construct(sprintf('The role "%s" is not allowed', $role));
    }
}
