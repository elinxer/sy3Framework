<?php

// example.com/src/Framework/ContentLengthListener.php

namespace Framework\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Framework\Events\ResponseEvent;

class ContentLengthListener implements EventSubscriberInterface
{

    /**
     * 响应监听事件
     *
     * @param ResponseEvent $event
     */
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length')
            && !$headers->has('Transfer-Encoding')
        ) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }

    /**
     * 获取订阅的监听事件
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array('response' => array('onResponse', -255));
    }

}
