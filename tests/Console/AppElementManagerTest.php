<?php

declare(strict_types=1);

namespace Tests\Console;

require __DIR__ . '/../../vendor/autoload.php';

use App\Console\AppElementManager;
use App\Enum\AppElementType;
use Tester\Assert;
use Tester\TestCase;

class AppElementManagerTest extends TestCase
{
    public function __construct(
        private AppElementManager $AEM
    )
    {}

    public function setUp(): void
    {
        $this->AEM->setModuleFolder('testttttt');
    }

	public function testSuccess(): void
    {
        Assert::same('TestModule', $this->AEM->normalizeName('test', AppElementType::Module));
        Assert::same('TestPresenter', $this->AEM->normalizeName('test', AppElementType::Presenter));
        Assert::same('TestComponent', $this->AEM->normalizeName('test', AppElementType::Component));
    }

}