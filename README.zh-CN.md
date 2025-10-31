# TextManageBundle

[English](README.md) | [中文](README.zh-CN.md)

TextManageBundle 是一个 Symfony Bundle，提供文本格式化和处理的功能。

## 功能

- 纯文本处理
- Markdown 格式化
- Twig 模板解析

## 安装

```bash
composer require tourze/text-manage-bundle
```

在 `config/bundles.php` 中注册 Bundle：

```php
return [
    // ...
    Tourze\TextManageBundle\TextManageBundle::class => ['all' => true],
];
```

## 使用方法

### 基本用法

```php
use Tourze\TextManageBundle\Service\TextFormatter;

class MyService
{
    public function __construct(
        private readonly TextFormatter $textFormatter
    ) {
    }
    
    public function process(): string
    {
        // 基本文本处理
        return $this->textFormatter->formatText('Hello World');
    }
}
```

### Twig 语法处理

```php
// 传入参数解析 Twig 语法
$params = ['name' => 'John'];
$text = 'Hello {{ name }}!';
$result = $textFormatter->formatText($text, $params); // 返回 "Hello John!"

// 复杂 Twig 语法
$params = ['items' => ['apple', 'banana', 'orange']];
$text = '{% for item in items %}{{ item }}{% if not loop.last %}, {% endif %}{% endfor %}';
$result = $textFormatter->formatText($text, $params); // 返回 "apple, banana, orange"
```

### Markdown 处理

```php
// Markdown 格式化
$text = '# Title\n\n**Bold text**';
$result = $textFormatter->formatText($text); // 返回纯文本，移除 HTML 标签
```

## 装饰器模式

本包使用装饰器模式实现了文本格式化处理的链式调用：

1. `PlainFormatter` - 基本文本处理
2. `MarkdownFormatter` - Markdown 格式化（装饰 TextFormatter）
3. `TwigFormatter` - Twig 模板解析（装饰 TextFormatter）

## 单元测试

```bash
./vendor/bin/phpunit packages/text-manage-bundle/tests
```

## License

MIT
