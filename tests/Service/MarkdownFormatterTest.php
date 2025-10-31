<?php

namespace Tourze\TextManageBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use Tourze\TextManageBundle\Service\MarkdownFormatter;

/**
 * @internal
 */
#[CoversClass(MarkdownFormatter::class)]
#[RunTestsInSeparateProcesses]
final class MarkdownFormatterTest extends AbstractIntegrationTestCase
{
    private MarkdownFormatter $formatter;

    protected function onSetUp(): void
    {
        $this->formatter = self::getService(MarkdownFormatter::class);
    }

    public function testFormatTextConvertsMarkdownToPlainText(): void
    {
        $text = '# Markdown Title';
        $result = $this->formatter->formatText($text);

        $this->assertEquals('Markdown Title', $result);
    }

    public function testFormatTextStripsHtmlTags(): void
    {
        $text = '**Bold Text**';
        $result = $this->formatter->formatText($text);

        $this->assertEquals('Bold Text', $result);
    }

    public function testFormatTextTrimsSurroundingWhitespace(): void
    {
        $text = "  \n  # Markdown Title  \n  ";
        $result = $this->formatter->formatText($text);

        $this->assertEquals('Markdown Title', $result);
    }

    public function testFormatTextWithEmptyString(): void
    {
        $result = $this->formatter->formatText('');

        $this->assertEquals('', $result);
    }

    public function testFormatTextWithPlainText(): void
    {
        $text = 'Plain text without markdown';
        $result = $this->formatter->formatText($text);

        $this->assertEquals($text, $result);
    }
}
