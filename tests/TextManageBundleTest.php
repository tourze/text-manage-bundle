<?php

declare(strict_types=1);

namespace Tourze\TextManageBundle\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractBundleTestCase;
use Tourze\TextManageBundle\TextManageBundle;

/**
 * @internal
 */
#[CoversClass(TextManageBundle::class)]
#[RunTestsInSeparateProcesses]
#[Group('skip-database-tests')]
#[Group('skip-sqlite-tests')]
final class TextManageBundleTest extends AbstractBundleTestCase
{
}
