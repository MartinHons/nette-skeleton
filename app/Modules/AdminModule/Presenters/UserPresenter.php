<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Presenters;

use App\Modules\AdminModule\Components\UserSettingsControl\UserSettingsControl;
use App\Presenters\BasePresenter;

final class UserPresenter extends BasePresenter
{
    public function createComponentUserSettingsControl(): UserSettingsControl
    {
        return $this->multiFactory->createUserSettingsControl();
    }
}
