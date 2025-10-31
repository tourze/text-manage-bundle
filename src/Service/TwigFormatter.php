<?php

namespace Tourze\TextManageBundle\Service;

use Monolog\Attribute\WithMonologChannel;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutowireDecorated;
use Twig\Environment;

#[AsDecorator(decorates: TextFormatter::class, priority: -99)]
#[Autoconfigure(public: true)]
#[WithMonologChannel(channel: 'text_manage')]
class TwigFormatter implements TextFormatter
{
    public function __construct(
        #[AutowireDecorated] private readonly TextFormatter $inner,
        private readonly Environment $environment,
        private readonly LoggerInterface $logger,
    ) {
    }

    /**
     * @param array<string, mixed> $params
     */
    public function formatText(string $text, array $params = []): string
    {
        $text = $this->inner->formatText($text, $params);

        // 如果明确没带有Twig语法标记，就直接跳过下面的解析
        if (!str_contains($text, '{{') && !str_contains($text, '{%')) {
            return $text;
        }

        try {
            $template = $this->environment->createTemplate($text);

            return trim($template->render($params));
        } catch (\Throwable $exception) {
            $this->logger->error('解析模板变量数据时发生异常', [
                'exception' => $exception,
                'text' => $text,
                'params' => $params,
            ]);
        }

        return '';
    }
}
