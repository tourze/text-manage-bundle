<?php

namespace Tourze\TextManageBundle\Tests\DependencyInjection;

use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\PHPUnitSymfonyUnitTest\AbstractDependencyInjectionExtensionTestCase;
use Tourze\TextManageBundle\DependencyInjection\TextManageExtension;

/**
 * @internal
 */
#[CoversClass(TextManageExtension::class)]
final class TextManageExtensionTest extends AbstractDependencyInjectionExtensionTestCase
{
    private TextManageExtension $extension;

    private ContainerBuilder $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->extension = new TextManageExtension();
        $this->container = new ContainerBuilder();
    }

    public function testLoadLoadsExtension(): void
    {
        // 设置必需的参数
        $this->container->setParameter('kernel.environment', 'test');

        // 测试扩展能否正常加载而不抛出异常
        $this->extension->load([], $this->container);

        // 验证容器中至少有一些服务定义
        $serviceDefinitions = $this->container->getDefinitions();
        $hasTextManageServices = false;

        foreach ($serviceDefinitions as $id => $definition) {
            if (is_string($id) && 0 === strpos($id, 'Tourze\TextManageBundle')) {
                $hasTextManageServices = true;
                break;
            }
        }

        $this->assertTrue($hasTextManageServices, '容器中应该包含TextManageBundle服务');
    }
}
