<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\LoginControl;

use Nette\Application\UI\Control;

final class LoginControl extends Control
{
    public function render(): void
    {
        $this->template->render(__DIR__.'/LoginControl.latte');
    }
}
