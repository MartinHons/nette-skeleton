<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Presenters;

use App\Entity\User\User;
use App\Enum\UserType;
use App\Presenters\BasePresenter;
use DateTimeImmutable;

final class DashboardPresenter extends BasePresenter
{

    public function actionDefault(): void
    {
        //bdump($this->orm);
    }
}
