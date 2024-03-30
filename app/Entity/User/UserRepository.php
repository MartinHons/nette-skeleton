<?php

declare(strict_types=1);

namespace App\Entity\User;

use Nextras\Orm\Repository\Repository;

final class UserRepository extends Repository
{
    static function getEntityClassNames(): array
    {
        return [User::class];
    }

}