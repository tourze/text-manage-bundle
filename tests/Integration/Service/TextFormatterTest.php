<?php

namespace Tourze\TextManageBundle\Tests\Integration\Service;

use PHPUnit\Framework\TestCase;
use Tourze\TextManageBundle\Service\TextFormatter;

class TextFormatterTest extends TestCase
{
    public function testInterfaceConstantValue(): void
    {
        $this->assertSame('text.formatter', TextFormatter::SERVICE_TAG);
    }
}