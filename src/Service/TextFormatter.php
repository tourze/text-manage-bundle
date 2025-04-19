<?php

namespace Tourze\TextManageBundle\Service;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(TextFormatter::SERVICE_TAG)]
interface TextFormatter
{
    public const SERVICE_TAG = 'text.formatter';

    /**
     * 格式化文本
     */
    public function formatText(string $text, array $params = []): string;
}
