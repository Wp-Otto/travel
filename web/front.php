<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/1/17
 * Time: 18:09
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpKernel\HttpCache\Esi;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\EventListener\StreamedResponseListener;

$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher ->addSubscriber(new Simplex\GoogleListener());
$dispatcher ->addSubscriber(new Simplex\ContentLengthListener());

$dispatcher ->addSubscriber(new RouterListener($matcher, $requestStack));

$listener = new ExceptionListener(
    'Calendar\\Controller\\ErrorController::exceptionAction'
);
$dispatcher->addSubscriber($listener);

$dispatcher->addSubscriber(new ResponseListener('UTF-8'));

//$dispatcher->addSubscriber(new StreamedResponseListener());

$dispatcher->addSubscriber(new Simplex\StringResponseListener());

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Simplex\Framework($dispatcher, $controllerResolver, $requestStack, $argumentResolver);
$framework = new HttpCache(
    $framework,
    new Store(__DIR__.'/../cache'),
    new Esi(),
    array('debug' => true)
);

$framework->handle($request)->send();