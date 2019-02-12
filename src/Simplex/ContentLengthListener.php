<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/2/12
 * Time: 10:39
 */

namespace Simplex;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ContentLengthListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents() {
        return array('response' => array('onResponse', -255));
    }

    public function onResponse(ResponseEvent $event) {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }
}