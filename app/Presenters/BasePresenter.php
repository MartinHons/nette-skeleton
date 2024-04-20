<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Enum\TemplateWrapperType;
use App\Helpers\MultiFactory;
use App\Modules\AdminModule\Presenters\LogPresenter;
use App\Nextras\Orm;
use Nette\Application\UI\Presenter;
use Nette\HtmlStringable;
use Nette\Http\Request;
use Nette\Utils\FileSystem;
use Nette\Utils\Html;
use Nette\Utils\Strings;
use stdClass;

abstract class BasePresenter extends Presenter
{
    public TemplateWrapperType $templateWrapperType = TemplateWrapperType::Main;

    public function __construct(
        private Request $request,
        protected MultiFactory $multiFactory,
        protected Orm $orm
    )
    {
        parent::__construct();

    }

    protected function beforeRender(): void
    {
        parent::beforeRender();
        $this->initAssets();
        $this->template->logPresenter = ($this->presenter::class === LogPresenter::class);
    }

    private function initAssets(): void
    {
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


    public function flashMessage(string|stdClass|HtmlStringable $message, string $type = 'info'): stdClass
	{
		if ($this->isAjax()) {
			$this->redrawControl('flashes');
		}

		return parent::flashMessage($message, $type);
	}

}

