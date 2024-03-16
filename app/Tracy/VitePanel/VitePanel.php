<?php

declare(strict_types=1);

namespace App\Tracy\VitePanel;

use Tracy\IBarPanel;

class VitePanel implements IBarPanel
{
    public function getTab()
    {
        return file_get_contents(__DIR__ . '/VitePanel.html');
    }

    public function getPanel()
    {
        return '';
    }
}