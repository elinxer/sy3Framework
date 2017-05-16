<?php
namespace App\Mobile\Controller;

use Symfony\Component\HttpFoundation\Response;

class IndexController
{

    public function indexAction()
    {
        $response = new Response('ddd'.rand());
        $response->setTtl(5);
        return $response;

    }


}