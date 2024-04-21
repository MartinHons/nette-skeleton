<?php

declare(strict_types=1);

namespace App\Entity\TimeTracker;

use Nextras\Orm\Entity\Entity;
use DateTimeImmutable;
use DateInterval;

/**
 * @property int                        $id {primary}
 * @property DateTimeImmutable          $date
 * @property string                     $name
 * @property DateInterval|null     $runned
 * @property int                        $totalTime
 */
class TimeTracker extends Entity
{
}

