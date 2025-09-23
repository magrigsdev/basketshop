<?php 

namespace App\Exception;

class InvalidEmailException extends \InvalidArgumentException
{
    public function __construct(string $email)
    {
        parent::__construct(sprintf('the email "%s" is not valid.', $email));
    }
}