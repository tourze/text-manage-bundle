<?php

namespace Tourze\TextManageBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tourze\TextManageBundle\DependencyInjection\TextManageExtension;

class TextManageExtensionTest extends TestCase
{
    /**
     * @var TextManageExtension
     */
    private TextManageExtension $extension;

    /**
     * @var ContainerBuilder
     */
    private ContainerBuilder $container;

    protected function setUp(): void
    {
        $this->extension = new TextManageExtension();
        $this->container = new ContainerBuilder();
    }

    public function test_load_loadsExtension(): void
    {
        // 测试扩展能否正常加载而不抛出异常
        $this->extension->load([], $this->container);

        // 验证容器中至少有一些服务定义
        $serviceDefinitions = $this->container->getDefinitions();
        $hasTextManageServices = false;

        foreach ($serviceDefinitions as $id => $definition) {
            if (is_string($id) && strpos($id, 'Tourze\TextManageBundle') === 0) {
                $hasTextManageServices = true;
                break;
            }
        }

        $this->assertTrue($hasTextManageServices, '容器中应该包含TextManageBundle服务');
    }
}
