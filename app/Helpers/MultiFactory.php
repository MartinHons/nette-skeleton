<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Modules\AdminModule\Components\Log\LoginControl\LoginControl;
use App\Modules\AdminModule\Components\UserSettingsControl\UserSettingsControl;

interface MultiFactory
{
	function createUserSettingsControl(): UserSettingsControl;
	function createLoginControl(): LoginControl;
}
