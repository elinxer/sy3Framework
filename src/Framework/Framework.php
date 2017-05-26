<?php

namespace Framework;


use Symfony\Component\HttpKernel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


class Framework extends HttpKernel\HttpKernel
{

    /**
     * Framework constructor.
     * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $container
     */
    public function __construct($container)
    {
        // 获取容器句柄
        $makeClas = new Container\FactoryClass($container);
        $dispatcher = $makeClas->make('dispatcher');
        $dispatcher->addSubscriber($makeClas->make('listener.router'));

        // 监听捕捉错误信息
        $dispatcher->addSubscriber(new HttpKernel\EventListener\ExceptionListener(function (HttpKernel\Exception\FlattenException $exception) {
            $msg = 'Wrong! ('.$exception->getMessage().')';
            return new Response($msg, $exception->getStatusCode()?:-1024);
        }));
        $dispatcher->addSubscriber(new HttpKernel\EventListener\ExceptionListener(new RouteNotFoundException()));

        $dispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));
        $dispatcher->addSubscriber(new HttpKernel\EventListener\StreamedResponseListener());
        $dispatcher->addSubscriber(new Listener\StringResponseListener());

        // 添加GA监听例子
        //$dispatcher->addSubscriber(new Listener\GoogleListener());

        parent::__construct($dispatcher, $makeClas->make('resolver'));
    }

    
}