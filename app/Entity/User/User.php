<?php

declare(strict_types=1);

namespace App\Entity\User;

use Nextras\Orm\Entity\Entity;
use App\Enum\UserType;
use DateTimeImmutable;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\SimpleIdentity;

/**
 * @property int                $id {primary}
 * @property string             $name
 * @property DateTimeImmutable  $created
 * @property UserType           $type
 */
class User extends Entity implements Authenticator
{
	function authenticate(string $username, string $password): IIdentity
    {
        return new SimpleIdentity(1);
    }
}

