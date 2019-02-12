<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/2/12
 * Time: 10:39
 */

namespace Simplex;


class ContentLengthListener
{
    public function onResponse(ResponseEvent $event) {
        $response = $event->getResponse();
        $headers = $response->headers;

        if (!$headers->has('Content-Length') && !$headers->has('Transfer-Encoding')) {
            $headers->set('Content-Length', strlen($response->getContent()));
        }
    }
}