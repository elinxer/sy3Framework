<?php

namespace Framework\Container;

/**
 * 类创建工厂
 *
 * Class FactoryClass
 * @package Framework
 */
class FactoryClass
{

    private $container;

    /**
     * FactoryClass constructor.
     * @param $container
     */
    public function __construct($container)
    {
        // 获取容器句柄
        $this->container = $container;
    }

    /**
     * 创建注册类
     *
     * @param string $className
     * @return mixed
     */
    public function make($className)
    {
        return $this->container->get($className);
    }


}