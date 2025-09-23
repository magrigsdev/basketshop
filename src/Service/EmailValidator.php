<?php

namespace App\Service;

use App\Exception\InvalidEmailException;

class EmailValidator 
{
    public function validate(string $email)
    {
        throw new InvalidEmailException($email);  
    }
}