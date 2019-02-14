<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/1/17
 * Time: 18:09
 */

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpKernel\HttpCache\Esi;

$request = Request::createFromGlobals();

$sc = include  __DIR__.'/../src/container.php';

//$sc->setParameter('debug', true);
$sc->setParameter('charset', 'UTF-8');
$sc->setParameter('routes', include __DIR__.'/../src/app.php');

$framework = $sc->get('framework');

//$framework = new HttpCache(
//    $framework,
//    new Store(__DIR__.'/../cache'),
//    new Esi(),
//    array('debug' => true)
//);

$framework->handle($request)->send();