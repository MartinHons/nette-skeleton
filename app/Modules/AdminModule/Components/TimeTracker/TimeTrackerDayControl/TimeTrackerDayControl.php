<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\TimeTracker\TimeTrackerDayControl;

use App\Helpers\MultiFactory;
use DateTimeImmutable;
use Nette\Application\UI\Control;
use Nette\Application\UI\Multiplier;

final class TimeTrackerDayControl extends Control
{
    /* @var array<callable:void> */
    public $onRun;
    private array $lines = [];

    public function __construct(
        private MultiFactory $multiFactory
    ){
        foreach([1,2,3,4,5] as $idLine) {
            $this->getComponent('timeTrackerLine-'.$idLine);
        }
    }

    public function init($day)
    {

    }

    protected function createComponentTimeTrackerLine(): Multiplier
    {
        return new Multiplier(function ($idLine) {
            $timeTrackerLine = $this->multiFactory->createTimeTrackerLineControl();
            $this->lines[$idLine] = $timeTrackerLine;

            $onRun = function($idLine) {
                $this->pauseLines($idLine);
            };
            $timeTrackerLine->init((int)$idLine, $onRun);
            return $timeTrackerLine;
        });
    }

    private function pauseLines(?int $idLineRunning = null): void
    {
        foreach($this->lines as $idLine => $line) {
            if ($idLine !== $idLineRunning) {
                $line->pause();
            }
        }
    }

    public function render(): void
    {
        $this->template->lines = $this->lines;
        $this->template->render(__DIR__.'/TimeTrackerDayControl.latte');
    }
}