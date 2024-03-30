<?php

declare(strict_types=1);

namespace App\Nextras;

use Nextras\Orm\Model\Model;
use App\Entity\User\UserRepository;

/**
 * @property-read UserRepository $user
 */
class Orm extends Model
{
}