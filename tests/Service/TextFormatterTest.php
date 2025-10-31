<?php

namespace Tourze\TextManageBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use Tourze\TextManageBundle\Service\TextFormatter;

/**
 * @internal
 */
#[CoversClass(TextFormatter::class)]
#[RunTestsInSeparateProcesses]
final class TextFormatterTest extends AbstractIntegrationTestCase
{
    protected function onSetUp(): void
    {
    }

    public function testInterfaceConstantValue(): void
    {
        $this->assertSame('text.formatter', TextFormatter::SERVICE_TAG);
    }
}
