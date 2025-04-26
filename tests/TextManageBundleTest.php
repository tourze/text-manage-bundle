<?php

namespace Tourze\TextManageBundle\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\TextManageBundle\TextManageBundle;

class TextManageBundleTest extends TestCase
{
    public function test_instanceCanBeCreated(): void
    {
        $bundle = new TextManageBundle();
        $this->assertInstanceOf(TextManageBundle::class, $bundle);
    }
}
