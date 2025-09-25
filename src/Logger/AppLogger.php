<?php

namespace App\Logger;

use Psr\Log\LoggerInterface;

class AppLogger
{
    private LoggerInterface $loggerInterface;

    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->loggerInterface = $loggerInterface;
    }

    public function error(string $message, array $context = []): void
    {
        $this->loggerInterface->error($message, $context);
    }
}
