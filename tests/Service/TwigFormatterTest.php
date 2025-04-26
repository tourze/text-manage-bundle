<?php

namespace Tourze\TextManageBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Tourze\TextManageBundle\Service\TextFormatter;
use Tourze\TextManageBundle\Service\TwigFormatter;
use Twig\Environment;

class TwigFormatterTest extends TestCase
{
    private TwigFormatter $formatter;
    private TextFormatter $innerFormatter;
    private Environment $environment;
    private LoggerInterface $logger;

    protected function setUp(): void
    {
        $this->innerFormatter = $this->createMock(TextFormatter::class);
        $this->environment = $this->createMock(Environment::class);
        $this->logger = $this->createMock(LoggerInterface::class);

        $this->formatter = new TwigFormatter(
            $this->innerFormatter,
            $this->environment,
            $this->logger
        );
    }

    public function test_formatText_delegatesToInnerFormatter(): void
    {
        $text = 'Plain text without Twig syntax';
        $params = ['key' => 'value'];

        $this->innerFormatter
            ->expects($this->once())
            ->method('formatText')
            ->with($text, $params)
            ->willReturn($text);

        $this->environment
            ->expects($this->never())
            ->method('createTemplate');

        $result = $this->formatter->formatText($text, $params);

        $this->assertEquals($text, $result);
    }

    public function test_formatText_skipsProcessingWhenNoTwigSyntax(): void
    {
        $text = 'Text with no Twig syntax';

        $this->innerFormatter
            ->expects($this->once())
            ->method('formatText')
            ->willReturn($text);

        $this->environment
            ->expects($this->never())
            ->method('createTemplate');

        $result = $this->formatter->formatText($text);

        // TwigFormatter 只会在文本中包含 {{ 或 {% 时才处理
        $this->assertEquals($text, $result);
    }

    public function test_formatText_logsErrorOnException(): void
    {
        $templateText = '{{ invalid syntax }}';

        $this->innerFormatter
            ->method('formatText')
            ->willReturn($templateText);

        $this->environment
            ->method('createTemplate')
            ->willThrowException(new \RuntimeException('Twig error'));

        $this->logger
            ->expects($this->once())
            ->method('error')
            ->with(
                $this->equalTo('解析模板变量数据时发生异常'),
                $this->callback(function ($context) {
                    return isset($context['exception'])
                        && isset($context['text'])
                        && isset($context['params']);
                })
            );

        $result = $this->formatter->formatText($templateText);

        $this->assertEquals('', $result);
    }
}
