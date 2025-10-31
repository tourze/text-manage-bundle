<?php

namespace Tourze\TextManageBundle\Tests\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use Tourze\PHPUnitSymfonyKernelTest\AbstractIntegrationTestCase;
use Tourze\TextManageBundle\Service\TwigFormatter;

/**
 * @internal
 */
#[CoversClass(TwigFormatter::class)]
#[RunTestsInSeparateProcesses]
final class TwigFormatterTest extends AbstractIntegrationTestCase
{
    private TwigFormatter $formatter;

    protected function onSetUp(): void
    {
        $this->formatter = self::getService(TwigFormatter::class);
    }

    public function testFormatTextWithoutTwigSyntax(): void
    {
        $text = 'Plain text without Twig syntax';
        $result = $this->formatter->formatText($text);

        $this->assertEquals($text, $result);
    }

    public function testFormatTextWithTwigVariables(): void
    {
        $text = 'Hello {{ name }}!';
        $params = ['name' => 'World'];
        $result = $this->formatter->formatText($text, $params);

        $this->assertEquals('Hello World!', $result);
    }

    public function testFormatTextWithTwigLogic(): void
    {
        $text = '{% if show %}Visible{% endif %}';
        $params = ['show' => true];
        $result = $this->formatter->formatText($text, $params);

        $this->assertEquals('Visible', $result);
    }

    public function testFormatTextWithTwigLogicHidden(): void
    {
        $text = '{% if show %}Visible{% endif %}';
        $params = ['show' => false];
        $result = $this->formatter->formatText($text, $params);

        $this->assertEquals('', $result);
    }

    public function testFormatTextWithInvalidTwigSyntax(): void
    {
        $text = '{{ invalid.property.that.does.not.exist }}';
        $params = [];
        $result = $this->formatter->formatText($text, $params);

        $this->assertEquals('', $result);
    }
}
