<?php 

namespace App\Service;

use App\Entity\User;
use Composer\XdebugHandler\Status;

class GlobalService
{
    public function getUserFirstName(?User $user): string
    {
        return $user ? $user->getFirstName() : 'Guest';
    }

    public function Message(string $message, bool $state = false): ?string
    {
        return $state ? $message : null ;
    }
    
}