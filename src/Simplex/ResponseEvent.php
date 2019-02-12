<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/2/12
 * Time: 10:06
 */

namespace Simplex;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event
{
    private $request;
    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getRequest() {
        return $this->request;
    }

}