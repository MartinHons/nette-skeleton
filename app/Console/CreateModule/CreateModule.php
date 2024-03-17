<?php

declare(strict_types=1);

namespace App\Console\CreateComponent;

use App\Helpers\ConsoleHelper;
use Exception;
use Nette\Utils\FileSystem;
use Nette\Utils\Strings;
use Nette\Utils\Validators;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Throwable;

#[AsCommand(
    name: 'create:module',
    description: 'Vytvoří nový modul',
)]
final class CreateComponent extends Command
{
	public function __construct(
		private ConsoleHelper $consoleHelper
	)
	{
		parent::__construct();
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$moduleName = $this->moduleQuestion($input, $output);
		$helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Bude vytvořen modul <fg=green;options=bold>'.$moduleName.'</>. Chcete pokračovat? [a/n]: ', false, '/^a/i');
        if (!$helper->ask($input, $output, $question)) {
            return Command::SUCCESS;
        }

		try {
			$this->createModule($moduleName);
			$output->writeln('<bg=green;options=bold>Byl vytvořen modul '.$moduleName.'.</>');
			return Command::SUCCESS;

		} catch (Throwable $e) {
			return Command::FAILURE;
		}
	}

	// Vrátí název modulu kterých chce uživatel vytvořit
	private function moduleQuestion(InputInterface $input, OutputInterface $output): string
	{
		$question = new Question('Zadejte název nového modulu: ');
		$helper = $this->getHelper('question');
		$modules = $this->consoleHelper->getModules();

		do {
			$moduleName = $helper->ask($input, $output, $question);
			if ($moduleName) {
				try {
					$moduleName = $this->normalizeModuleName($moduleName);
					if (in_array($moduleName, $modules)) {
						throw new Exception('Modul '.$moduleName.' již existuje.');
					}
				}
				catch(Throwable $e) {
					$output->writeln('<error>'.$e->getMessage().'</error>');
					$moduleName = null;
				}
			}
		} while(!$moduleName);

		return $moduleName;
	}

	// Vrátí normalizovaný název modulu
	private function normalizeModuleName(string $moduleName): string
	{
		if (!strlen(str_replace('module', '', Strings::lower($moduleName)))) {
			// Byl zadáno pouze "module"
			throw new Exception('Modul se nemůže jmenovat "'.$moduleName.'"');
		}
		elseif (!Validators::isPhpIdentifier($moduleName)) {
			throw new Exception('"'.$moduleName.'" není validní název pro PHP třídu.');
		}

		$moduleName = Strings::firstUpper($moduleName);
		$moduleName = str_replace('module', 'Module', $moduleName);

		if (!str_ends_with($moduleName, 'Module')) {
			$moduleName .= 'Module';
		}
		return $moduleName;
	}

	// Vytvoří modul
	private function createModule(string $moduleName): void
	{
		$moduleRoot = 'app/Modules/'.$moduleName;
		FileSystem::createDir($moduleRoot);
		FileSystem::createDir($moduleRoot.'/Components');
		FileSystem::createDir($moduleRoot.'/Presenters');
		FileSystem::createDir($moduleRoot.'/Presenters/templates');
		FileSystem::createDir($moduleRoot.'/Scripts');
		FileSystem::createDir($moduleRoot.'/Styles');
	}

}