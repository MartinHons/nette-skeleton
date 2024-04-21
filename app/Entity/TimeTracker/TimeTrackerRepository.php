<?php

declare(strict_types=1);

namespace App\Entity\TimeTracker;

use App\Entity\TimeTracker\TimeTracker;
use Nextras\Orm\Repository\Repository;

final class TimeTrackerRepository extends Repository
{
    static function getEntityClassNames(): array
    {
        return [TimeTracker::class];
    }

}