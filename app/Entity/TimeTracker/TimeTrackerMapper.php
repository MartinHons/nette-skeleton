<?php

declare(strict_types=1);

namespace App\Entity\TimeTracker;

use Nextras\Orm\Mapper\Dbal\DbalMapper;

class TimeTrackerMapper extends DbalMapper
{
    protected $tableName = 'time_tracker';
}