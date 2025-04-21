<?php

namespace Tourze\TextManageBundle\Service;

use League\CommonMark\MarkdownConverter;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;

#[AsDecorator(decorates: TextFormatter::class, priority: -89)]
class MarkdownFormatter implements TextFormatter
{
    public function __construct(
        #[AutowireDecorated] private readonly TextFormatter $inner,
        private readonly MarkdownConverter $commonMarkConverter,
    ) {
    }

    public function formatText(string $text, array $params = []): string
    {
        $text = $this->inner->formatText($text, $params);

        $result = trim($this->commonMarkConverter->convert($text)->getContent());
        $result = strip_tags($result);

        return trim($result);
    }
}
