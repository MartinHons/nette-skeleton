<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;


class Bootstrap
{
	public static function boot(): Configurator
	{
		$configurator = new Configurator;
		$appDir = dirname(__DIR__);
		$configurator->setDebugMode(true); // enable for your remote IP
		$configurator->enableTracy($appDir . '/log');

		$configurator->setTempDirectory($appDir . '/temp');

		$configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();

		$configurator->addConfig($appDir . '/config/common.neon');
		$configurator->addConfig($appDir . '/config/services.neon');
		$configurator->addConfig($appDir . '/config/local.neon');
		$configurator->addConfig($appDir . '/config/multifactory.neon');
		$configurator->addConfig($appDir . '/config/console.neon');
		$configurator->addConfig($appDir . '/config/nextras.neon');

		define('DEBUG_MODE', $configurator->isDebugMode());

		return $configurator;
	}
}
