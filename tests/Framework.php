<?php
/**
 * 框架初始化测试
 */
namespace Tests;

use Framework\Framework;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

require_once __DIR__ . '/../vendor/autoload.php';
define("ROOT_PATH", __DIR__ . '/../'); // 根目录 - 需求根据项目更改

class FrameworkTest extends \PHPUnit\Framework\TestCase
{
    public function testNotFoundHandling()
    {
        $framework = $this->getFrameworkForException(new ResourceNotFoundException());
        $response = $framework->handle(new Request());
        $this->assertEquals(200, $response->getStatusCode());
    }

    protected function getFrameworkForException($exception)
    {
        $container = include ROOT_PATH . '/app/container.php'; // 容器定义 - 需根据项目更改
        return new Framework($container);
    }

}