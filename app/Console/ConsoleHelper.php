<?php

declare(strict_types=1);

namespace App\Console;

use App\Enum\AppElementType;
use Nette\Utils\FileSystem;
use Symfony\Component\Process\Process;

class ConsoleHelper
{
	public function normalizeName(string $name, AppElementType $appElementType): string
	{
		// TODO zde se mohou validovat obecné věci jako test php class

		return match ($appElementType) {
			AppElementType::Module => $this->normalizeModuleName(),
			AppElementType::Presenter => $this->normalizePresenterName()
		};
	}

	public function replaceAndSave(string $sourceFile, string $targetFile, array $replace)
    {
        $replaceFrom = array_keys($replace);
        $replaceTo = array_values($replace);
        $targetFile = fopen($targetFile, 'w');

        $lines = FileSystem::readLines($sourceFile);
		foreach ($lines as $line) {
			$line = str_replace($replaceFrom, $replaceTo, $line);
            fwrite($targetFile, $line."\n");
		}
        fclose($targetFile);
    }

    // Vrátí názvy všech existujících modulů
	public function getModules(): array
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

	public function runScript(string $scriptPath): void
	{
		$process = new Process([$scriptPath]);
        $process->start();
        foreach ($process as $data) {
            echo $data;
        }
	}
}
