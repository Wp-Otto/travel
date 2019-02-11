<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/1/18
 * Time: 10:36
 */
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('hello',new Route('/hello/{name}',array('name' => 'World')));
$routes->add('bye',new Route('/bye'));

return $routes;