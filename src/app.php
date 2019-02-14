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

$routes->add('year', new Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
)));


return $routes;