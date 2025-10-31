<?php

namespace Tourze\TextManageBundle\Service;

use League\CommonMark\MarkdownConverter;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;

#[AsDecorator(decorates: TextFormatter::class, priority: -89)]
#[Autoconfigure(public: true)]
class MarkdownFormatter implements TextFormatter
{
    public function __construct(
        #[AutowireDecorated] private readonly TextFormatter $inner,
        private readonly MarkdownConverter $commonMarkConverter,
    ) {
    }

    /**
     * @param array<string, mixed> $params
     */
    public function formatText(string $text, array $params = []): string
    {
        $text = $this->inner->formatText($text, $params);

        $result = trim($this->commonMarkConverter->convert($text)->getContent());
        $result = strip_tags($result);

        return trim($result);
    }
}
