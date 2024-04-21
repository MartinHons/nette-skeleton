<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Presenters;

use App\Entity\TimeTracker\TimeTracker;
use App\Modules\AdminModule\Components\TimeTracker\TimeTrackerDayControl\TimeTrackerDayControl;
use App\Presenters\BasePresenter;
use DateTime;
use DateTimeImmutable;
use Nette\Application\UI\Multiplier;

final class TimeTrackerPresenter extends BasePresenter
{
    private array $days = [];


    public function actionDefault(): void
    {
        foreach($this->orm->timeTracker->findAll() as $line) {
            bdump($line->runned);
        }
    }

    protected function createComponentTimeTrackerDay(): Multiplier
    {
        return new Multiplier(function ($day) {
            $timeTrackerDay = $this->multiFactory->createTimeTrackerDayControl();
            $this->days[$day] = $timeTrackerDay;
            $timeTrackerDay->init($day);
            return $timeTrackerDay;
        });
    }
}
