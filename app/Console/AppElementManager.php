<?php

declare(strict_types=1);

namespace App\Console;

use App\Enum\AppElementType;
use Exception;
use Nette\Utils\FileSystem;
use Nette\Utils\Strings;
use Nette\Utils\Validators;

class AppElementManager
{
    private $moduleFolder = 'app/Modules';

    public function setModuleFolder(string $moduleFolder): void
    {
        FileSystem::createDir($moduleFolder);
        $this->moduleFolder = $moduleFolder;
    }

    public function normalizeName(string $name, AppElementType $appElementType): string
	{
        if(empty($name)) {
            // Prázdný string $name
			throw new Exception('Nelze vytvořit '.$appElementType->czechAccusative().' bez názvu.');
        }

        $defaultName = $name;
        if(str_ends_with(Strings::lower($name), Strings::lower($appElementType->name))) {
            // Pokud má $name suffix (např. "module") tak jej z názvu odstraníme
            $name = Strings::substring($name, 0, strlen($name) - strlen($appElementType->name));
        }
        if(empty($name)) {
            // $name obsahoval pouze suffix
			throw new Exception('Nelze vytvořit '.$appElementType->czechAccusative().' s názvem "'.$defaultName.'".');
        }

        // První písmeno musí být velké
        $name = Strings::firstUpper($name);

        // Do $name vrátíme suffix
        $name .= $appElementType->name;

        if (!Validators::isPhpIdentifier($name)) {
            throw new Exception('"'.$name.'" není validní název pro PHP třídu.');
        }
        return $name;
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
}
