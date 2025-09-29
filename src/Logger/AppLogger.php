<?php

namespace App\Logger;

use Psr\Log\LoggerInterface;

class AppLogger
{
    public function __construct(private LoggerInterface $loggerInterface)
    {
        $this->loggerInterface = $loggerInterface;
    }

    public function error(string $message, array $context = []): void
    {
        $this->loggerInterface->error($message, $context);
    }

    public function debug(string $message, array $context = []): void
    {
        $this->loggerInterface->debug($message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        $this->loggerInterface->info($message, $context);
    }

}
