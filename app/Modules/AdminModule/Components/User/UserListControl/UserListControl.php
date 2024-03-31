<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\UserListControl;

use Nette\Application\UI\Control;

final class UserListControl extends Control
{
    public function render(): void
    {
        $this->template->render(__DIR__.'/UserListControl.latte');
    }
}
