<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\TimeTracker\TimeTrackerLineControl;

use Nette\Application\UI\Control;
use Nette\Utils\Callback;

final class TimeTrackerLineControl extends Control
{
    /* @var array<callable:void> */
    public $onRun;
    private int $idLine;
    private bool $running = false;

    public function init(int $idLine, $onRun): void
    {
        $this->idLine = $idLine;
        $this->onRun[] = $onRun;
    }

    public function handleRunningClick(bool $value): void
    {
        $this->running = $value;
        $this->onRun($this->idLine);
        $this->redrawControl('line');
    }

    public function pause(): void
    {
        bdump('pause'.$this->idLine);
        $this->running = false;
        $this->redrawControl('line');
    }

    public function render(): void
    {
        $this->template->running = $this->running;
        $this->template->render(__DIR__.'/TimeTrackerLineControl.latte');
    }
}