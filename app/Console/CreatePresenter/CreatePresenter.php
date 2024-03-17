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
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Throwable;

#[AsCommand(
    name: 'create:presenter',
    description: 'Vytvoří nový presenter',
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
		$presenterName = $this->presenterQuestion($input, $output, $moduleName);

        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Bude vytvořen presenter '.$moduleName.'/'.$presenterName.'. Chcete pokračovat? [a/n]: ', false, '/^a/i');
        if (!$helper->ask($input, $output, $question)) {
            return Command::SUCCESS;
        }
		try {
			$this->createPresenter($moduleName, $presenterName);
			$output->writeln('<info>Byl vytvořen presenter '.$moduleName.'/'.$presenterName.'.</info>');
			return Command::SUCCESS;

		} catch (Throwable $e) {
			$output->writeln($e->getMessAGE());
			return Command::FAILURE;
		}
	}

	// Vrátí název modulu který uživatel vybral
	private function moduleQuestion(InputInterface $input, OutputInterface $output): string
	{
		$modules = $this->getModules();
		if (!count($modules)) {
			$output->writeln('<error>Aplikace nemá žádné moduly. Vytvořte nejdříve nějaký pomocí create:module</error>');
			return Command::FAILURE;
		}
		$helper = $this->getHelper('question');
		$question = new ChoiceQuestion('Vyberte modul do kterého bude nový presenter patřit:', $modules);
		$question->setErrorMessage('Vybírejte pouze z možností 1-'.count($modules));
		return $helper->ask($input, $output, $question);
	}

	// Vrátí názvy všech existujících presenterů
	private function getModules(): array
	{
		$folders = array_filter(scandir('app/Modules'), fn($folder) => str_ends_with($folder, 'Module'));
		sort($folders);
		$modules = [];
		$i = 1;
		foreach($folders as $folder) {
			$modules[$i++] = $folder;
		}
		return $modules;
	}

	// Vrátí název presenteru kterých chce uživatel vytvořit
	private function presenterQuestion(InputInterface $input, OutputInterface $output, string $moduleName): string
	{
		$question = new Question('Zadejte název nového presenteru: ');
		$helper = $this->getHelper('question');

		do {
			$presenterName = $helper->ask($input, $output, $question);
			if ($presenterName) {
				try {
					$presenterName = $this->normalizePresenterName($presenterName);
					if ($this->presenterExists($moduleName, $presenterName)) {
						throw new Exception('Presenter '.$moduleName.'/'.$presenterName.' již existuje.');
					}
				}
				catch(Throwable $e) {
					$output->writeln('<error>'.$e->getMessage().'</error>');
					$presenterName = null;
				}
			}
		} while(!$presenterName);

		return $presenterName;
	}

	// Vrátí normalizovaný název presenteru
	private function normalizePresenterName(string $presenterName): string
	{
		if (!strlen(str_replace('presenter', '', Strings::lower($presenterName)))) {
			// Byl zadáno pouze "presenter"
			throw new Exception('Presenter se nemůže jmenovat "'.$presenterName.'"');
		}
		elseif (!Validators::isPhpIdentifier($presenterName)) {
			throw new Exception('"'.$presenterName.'" není validní název pro PHP třídu.');
		}

		$presenterName = Strings::firstUpper($presenterName);
		$presenterName = str_replace('presenter', 'Presenter', $presenterName);

		if (!str_ends_with($presenterName, 'Presenter')) {
			$presenterName .= 'Presenter';
		}
		return $presenterName;
	}

	// Vrátí true/false podle toho zda presenter existuje
	private function presenterExists(string $moduleName, string $presenterName): bool
	{
		return file_exists('app/Modules/'.$moduleName.'/Presenters/'.$presenterName.'.php');
	}

	// Vytvoří presenter
	private function createPresenter(string $moduleName, string $presenterName): void
	{
		$sourceFile = 'app/Console/CreatePresenter/Presenter.template';
		$targetFile = 'app/Modules/'.$moduleName.'/Presenters/'.$presenterName.'.php';
		$replace = [
			'<module>' => $moduleName,
			'<presenter>' => $presenterName,
		];
		$this->consoleHelper->replaceAndSave($sourceFile, $targetFile, $replace);
	}

}