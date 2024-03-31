<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Presenters;

use App\Modules\AdminModule\Components\UserListControl\UserListControl;
use App\Modules\AdminModule\Components\UserSettingsControl\UserSettingsControl;
use App\Presenters\BasePresenter;

final class UserPresenter extends BasePresenter
{
    public function createComponentUserListControl(): UserListControl
    {
        return $this->multiFactory->createUserListControl();
    }

    public function createComponentUserSettingsControl(): UserSettingsControl
    {
        return $this->multiFactory->createUserSettingsControl();
    }
}
