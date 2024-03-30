<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\UserSettingsControl;

use Nette\Application\UI\Control;

final class UserSettingsControl extends Control
{
    public function render(): void
    {
        $this->template->render(__DIR__.'/UserSettingsControl.latte');
    }
}
