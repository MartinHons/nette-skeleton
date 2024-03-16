<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette\Application\UI\Presenter;
use Nette\Http\Request;
use Nette\Utils\FileSystem;
use Nette\Utils\Html;
use Nette\Utils\Strings;

abstract class BasePresenter extends Presenter
{
    public function __construct(
        private Request $request
    )
    {
        parent::__construct();

    }

    protected function beforeRender(): void
    {
        parent::beforeRender();
        $module = Strings::before($this->getName(), ':') . 'Module';
        $vite = ($this->request->getCookie('viteDev') === 'true');
        $this->template->scripts = '';
        $this->template->styles = '';

        $manifest = FileSystem::read('../www/build/.vite/manifest.json');

        $sources = json_decode($manifest, true);
        if ($vite) {
            $sources[$module.'/Scripts']['src'] = '@vite/client';
        }

        foreach($sources as $source => $data) {
            if (str_contains($source, $module)) {
                if (DEBUG_MODE && $vite) {
                    $file = VITE_SERVER.'/'.$data['src'];
                }
                else {
                    $file = '/build/'.$data['file'];
                }
                if (str_contains($source, 'Scripts')) {
                    $el = Html::el('script')->src($file);
                    if ($vite) {
                        $el->type = 'module';
                    }
                    $this->template->scripts .= $el->__toString();
                }
                elseif (str_contains($source, 'Styles')) {
                    $el = Html::el('link')->rel('stylesheet')->href($file);
                    $this->template->styles .= $el->__toString();
                }
            }
        }
    }
}
