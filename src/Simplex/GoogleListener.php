<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/2/12
 * Time: 10:37
 */

namespace Simplex;


class GoogleListener
{

    public function onResponse(ResponseEvent $event) {
        $response = $event->getResponse();

        if ($response->isRedirection() || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'),'html')) || 'html' !== $event->getRequest()->getRequestFormat()){
            return;
        }

        $response->setContent($response->getContent().'GA CODE');
    }
}