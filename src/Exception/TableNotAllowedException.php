<?php 

namespace App\Exception;

class TableNotAllowedException extends \RuntimeException
{
    public function __construct(string $message = "Accès non autorisé.", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message,$code,$previous);
    }
}