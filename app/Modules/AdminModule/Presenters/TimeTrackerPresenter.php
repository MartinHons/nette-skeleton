<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Presenters;

use App\Modules\AdminModule\Components\TimeTracker\TimeTrackerDayControl\TimeTrackerDayControl;
use App\Presenters\BasePresenter;

final class TimeTrackerPresenter extends BasePresenter
{
    public function createComponentTimeTrackerDay(): TimeTrackerDayControl
    {
        return $this->multiFactory->createTimeTrackerDayControl();
    }
}
