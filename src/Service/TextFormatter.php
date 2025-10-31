<?php

namespace Tourze\TextManageBundle\Service;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(name: TextFormatter::SERVICE_TAG)]
interface TextFormatter
{
    public const SERVICE_TAG = 'text.formatter';

    /**
     * 格式化文本
     *
     * @param array<string, mixed> $params
     */
    public function formatText(string $text, array $params = []): string;
}
