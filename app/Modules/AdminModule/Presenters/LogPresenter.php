<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Presenters;

use App\Enum\TemplateWrapperType;
use App\Modules\AdminModule\Components\Log\LoginControl\LoginControl;
use App\Presenters\BasePresenter;

final class LogPresenter extends BasePresenter
{
    public TemplateWrapperType $templateWrapperType = TemplateWrapperType::Centered;


    public function actionOut(): void
    {
        $this->user->logout();
        $this->flashMessage('Uživatel byl odhlášen');
        $this->redirect('Log:in');
    }

    public function createComponentLoginControl(): LoginControl
    {
        return $this->multiFactory->createLoginControl();
    }
}
