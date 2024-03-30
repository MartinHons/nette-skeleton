<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\Log\LoginControl;

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Throwable;

final class LoginControl extends Control
{
    public function createComponentLoginForm(): Form
    {
        $form = new Form;
        $form->addText('username', 'Přihlašovací jméno')
            ->setRequired('Vyplňte %label')
            ->setHtmlAttribute('placeholder', '')
            ->setHtmlAttribute('class', 'form-control');

        $form->addPassword('password', 'Heslo')
            ->setRequired('Vyplňte %label')
            ->setHtmlAttribute('placeholder', '')
            ->setHtmlAttribute('class', 'form-control');

        $form->addSubmit('send', 'Přihlásit se')
            ->setHtmlAttribute('class','btn btn-primary');

        $form->addProtection();
        $form->onSuccess[] = [$this, 'loginFormSuccess'];

        return $form;
    }

    public function loginFormSuccess(Form $form, array $values): void
    {
        try {
            $this->presenter->user->login($values['username'], $values['password']);
            $this->presenter->redirect('Dashboard:');
        }
        catch(AuthenticationException) {
            $this->presenter->flashMessage('Chyba', 'error');
        }
    }

    public function render(): void
    {
        $this->template->render(__DIR__.'/LoginControl.latte');
    }
}
