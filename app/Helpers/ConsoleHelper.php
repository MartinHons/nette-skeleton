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
}
