<?php

declare(strict_types=1);

namespace App\Entity\User;

use Nextras\Orm\Entity\Entity;
use App\Enum\UserType;
use DateTimeImmutable;

/**
 * @property int                $id {primary}
 * @property string             $name
 * @property DateTimeImmutable  $created
 * @property UserType           $type
 */
class User extends Entity
{
}

