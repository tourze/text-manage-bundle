<?php

declare(strict_types=1);

namespace Tourze\TextManageBundle;

use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tourze\BundleDependency\BundleDependencyInterface;

class TextManageBundle extends Bundle implements BundleDependencyInterface
{
    public static function getBundleDependencies(): array
    {
        return [
            TwigBundle::class => ['all' => true],
        ];
    }
}
