<?php

namespace Tourze\TextManageBundle\Service;

use Symfony\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

#[AsAlias(TextFormatter::class)]
#[Autoconfigure(public: true)]
class PlainFormatter implements TextFormatter
{
    public function formatText(string $text, array $params = []): string
    {
        return $text;
    }
}
