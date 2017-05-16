<?php
/**
 * 路由表
 */
use Symfony\Component\Routing;
$routes = new Routing\RouteCollection();


// 首页
$routes->add('home', new Routing\Route('/', array(
    '_controller' => 'App\\Mobile\\Controller\\IndexController::indexAction',
)));



return $routes;
