<?php

declare(strict_types=1);

namespace App\Entity\User;

use Nextras\Orm\Mapper\Dbal\DbalMapper;

class UserMapper extends DbalMapper
{
    protected $tableName = 'user';
}