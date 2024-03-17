<?php

declare(strict_types=1);

namespace App\Helpers;

use Nette\Utils\FileSystem;

class ConsoleHelper
{
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
}
