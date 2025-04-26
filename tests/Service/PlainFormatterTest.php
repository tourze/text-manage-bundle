<?php

namespace Tourze\TextManageBundle\Tests\Service;

use PHPUnit\Framework\TestCase;
use Tourze\TextManageBundle\Service\PlainFormatter;

class PlainFormatterTest extends TestCase
{
    private PlainFormatter $formatter;

    protected function setUp(): void
    {
        $this->formatter = new PlainFormatter();
    }

    public function test_formatText_withPlainText_returnsOriginalText(): void
    {
        $text = 'Hello World';
        $result = $this->formatter->formatText($text);

        $this->assertEquals($text, $result);
    }

    public function test_formatText_withEmptyText_returnsEmptyString(): void
    {
        $result = $this->formatter->formatText('');

        $this->assertEquals('', $result);
    }

    public function test_formatText_withSpecialCharacters_returnsUnchangedText(): void
    {
        $text = '<div>HTML content</div>';
        $result = $this->formatter->formatText($text);

        $this->assertEquals($text, $result);
    }

    public function test_formatText_withParamsProvided_ignoresParams(): void
    {
        $text = 'Hello {{ name }}';
        $params = ['name' => 'John'];
        $result = $this->formatter->formatText($text, $params);

        $this->assertEquals($text, $result);
    }
}
