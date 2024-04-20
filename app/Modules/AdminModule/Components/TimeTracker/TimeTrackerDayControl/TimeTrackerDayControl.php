<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\TimeTracker\TimeTrackerDayControl;

use App\Helpers\MultiFactory;
use App\Modules\AdminModule\Components\TimeTracker\TimeTrackerLineControl\TimeTrackerLineControl;
use Nette\Application\UI\Control;
use Nette\Application\UI\Multiplier;

final class TimeTrackerDayControl extends Control
{
    public function __construct(
        private MultiFactory $multiFactory
    ){}

    /*
    public function createComponentTimeTrackerLine(): TimeTrackerLineControl
    {
        return $this->multiFactory->createTimeTrackerLineControl();
    }*/

    protected function createComponentTimeTrackerLine(): Multiplier
    {
        return new Multiplier(function ($idLine) {
            $timeTrackerLine = $this->multiFactory->createTimeTrackerLineControl();
            bdump($idLine);
            return $timeTrackerLine;
        });
    }


    public function render(): void
    {
        $this->template->render(__DIR__.'/TimeTrackerDayControl.latte');
    }
}