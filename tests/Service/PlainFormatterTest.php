<?php

namespace Tourze\TextManageBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use Tourze\TextManageBundle\Service\PlainFormatter;

/**
 * @internal
 */
#[CoversClass(PlainFormatter::class)]
#[RunTestsInSeparateProcesses]
final class PlainFormatterTest extends AbstractIntegrationTestCase
{
    private PlainFormatter $formatter;

    protected function onSetUp(): void
    {
        $this->formatter = self::getService(PlainFormatter::class);
    }

    public function testFormatTextWithPlainTextReturnsOriginalText(): void
    {
        $text = 'Hello World';
        $result = $this->formatter->formatText($text);

        $this->assertEquals($text, $result);
    }

    public function testFormatTextWithEmptyTextReturnsEmptyString(): void
    {
        $result = $this->formatter->formatText('');

        $this->assertEquals('', $result);
    }

    public function testFormatTextWithSpecialCharactersReturnsUnchangedText(): void
    {
        $text = '<div>HTML content</div>';
        $result = $this->formatter->formatText($text);

        $this->assertEquals($text, $result);
    }

    public function testFormatTextWithParamsProvidedIgnoresParams(): void
    {
        $text = 'Hello {{ name }}';
        $params = ['name' => 'John'];
        $result = $this->formatter->formatText($text, $params);

        $this->assertEquals($text, $result);
    }
}
