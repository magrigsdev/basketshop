<?php

namespace App\Traits;

use App\Exception\TableNotAllowedException;
use App\Service\DynamicQueryService;
use App\Service\EmailValidator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

trait  RepositoryHelpersTrait
{
    use DateSearchTrait;
    use JoinSearchTrait;
    use SimpleSearchTrait;
    use SoftDeleteTrait;
    use UserFilteredTrait;
    use StatsTrait;
    use UserFilteredTrait;

    private EmailValidator $email_validator;
    private DynamicQueryService $dynamic_query;
    private UserPasswordHasherInterface $passwordHasher;
    private array $White_list = ['user','category','products','visit'];

    // ****************  PROTECTED FUNCTIONS ****************************
     /**
     * Retourne une exception si la table n'existe pas.
     */
    
   

}
