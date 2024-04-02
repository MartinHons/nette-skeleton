<?php

declare(strict_types=1);

namespace App\Entity\User;

use Nextras\Orm\Entity\Entity;
use App\Enum\UserType;
use App\Enum\UserRole;
use DateTimeImmutable;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\SimpleIdentity;

/**
 * @property int                $id {primary}
 * @property UserRole           $role
 * @property UserType           $type
 * @property string             $firstname
 * @property string             $surname
 * @property string             $company
 * @property string             $fullName {virtual}
 * @property string             $avatar
 * @property DateTimeImmutable  $created {default now}
 */
class User extends Entity implements Authenticator
{
	public function authenticate(string $username, string $password): IIdentity
    {
        return new SimpleIdentity(1);
    }

    public function getterFullName(): string
    {
        return $this->type === UserType::Company ? $this->company : $this->firstName.' '.$this->surname;
    }
}

