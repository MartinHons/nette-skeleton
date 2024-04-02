<?php

declare(strict_types=1);

namespace App\Modules\AdminModule\Components\UserListControl;

use App\Entity\User\User;
use App\Nextras\Orm;
use Nette\Application\UI\Control;
use Ublaboo\DataGrid\DataGrid;

final class UserListControl extends Control
{
    public function __construct(
        private Orm $orm
    ){}

    public function createComponentGrid(): DataGrid
    {
        $grid = new DataGrid;
        $grid->setDataSource($this->orm->user->findAll());
        $grid->setItemsPerPageList([20, 50, 100], true);

        $grid->addColumnText('id', 'Id')
            ->setSortable();

        $grid->addColumnText('firstname', 'Jméno')
            ->setSortable()
            ->setFilterText();

        $grid->addColumnDateTime('created', 'Datum vytvoření')
            ->setSortable();

        $grid->setTemplateFile(__DIR__ . '/template.latte');

        /*
        $grid->addColumnNumber('type', 'Typ uživatele')
            ->setRenderer(function (User $user): string
            {
                bdump($user->type);
                return $user->type === 'person' ? 'Osoba' : 'Firma';
            });*/


        return $grid;
    }

    public function render(): void
    {
        $this->template->render(__DIR__.'/UserListControl.latte');
    }
}
