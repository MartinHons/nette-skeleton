<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Modules\AdminModule\Components\Log\LoginControl\LoginControl;
use App\Modules\AdminModule\Components\TimeTracker\TimeTrackerDayControl\TimeTrackerDayControl;
use App\Modules\AdminModule\Components\TimeTracker\TimeTrackerLineControl\TimeTrackerLineControl;
use App\Modules\AdminModule\Components\UserListControl\UserListControl;
use App\Modules\AdminModule\Components\UserSettingsControl\UserSettingsControl;

interface MultiFactory
{
	function createUserSettingsControl(): UserSettingsControl;
	function createLoginControl(): LoginControl;
	function createUserListControl(): UserListControl;
	function createTimeTrackerDayControl(): TimeTrackerDayControl;
	function createTimeTrackerLineControl(): TimeTrackerLineControl;
}
