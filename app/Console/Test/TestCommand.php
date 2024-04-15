<?php

declare(strict_types=1);

namespace App\Console\Test;

use App\Console\ConsoleHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Process\Process;

#[AsCommand(
    name: 'test',
    description: 'Spustí testy',
)]
final class TestCommand extends Command
{
    public function __construct(
        private ConsoleHelper $consoleHelper
    )
    {
        parent::__construct();
    }

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
        $this->consoleHelper->runScript(__DIR__.'/test.sh');
        return 0;
	}

}