<?php

declare(strict_types=1);

namespace App\Nextras;

use Nextras\Orm\Model\Model;
use App\Entity\User\UserRepository;
use App\Entity\TimeTracker\TimeTrackerRepository;

/**
 * @property-read UserRepository $user
 * @property-read TimeTrackerRepository $timeTracker
 */
class Orm extends Model
{
}