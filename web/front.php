<?php
/**
 * 空间入口地址例子
 */
define("ROOT_PATH", __DIR__ . '/../'); // 根目录 - 需求根据项目更改
define("CACHE_PATH", ROOT_PATH . '/cache'); // 缓存目录
require_once ROOT_PATH.'/vendor/autoload.php'; // 引入自动加载
// -- start --
$container = include ROOT_PATH . '/app/container.php'; // 容器定义 - 需根据项目更改
$framework = new Symfony\Component\HttpKernel\HttpCache\HttpCache(new \Framework\Framework($container), new Symfony\Component\HttpKernel\HttpCache\Store(CACHE_PATH));
$response = $framework->handle(Symfony\Component\HttpFoundation\Request::createFromGlobals());
$response->send();
// -- end --