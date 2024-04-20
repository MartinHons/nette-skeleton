<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\TimeTracker\TimeTrackerLineControl;

use Nette\Application\UI\Control;

final class TimeTrackerLineControl extends Control
{
    private bool $running = false;

    public function handleRunningClick(bool $value): void
    {
        $this->running = $value;
        $this->redrawControl('line');
    }

    public function render(): void
    {
        $this->template->running = $this->running;
        $this->template->render(__DIR__.'/TimeTrackerLineControl.latte');
    }
}