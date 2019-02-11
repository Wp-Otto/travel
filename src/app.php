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


$routes->add('hello',new Route('/hello/{name}',array(
    'name' => 'World',
    '_controller' => function ($request) {
//        添加属性  可用于模板中
        $request->attributes->set('foo', 'bar');

        $response = render_template($request);

//        修改头信息
        $response->headers->set('Content-Type', 'text/plain');
        return $response;
    }
)));

$routes->add('bye',new Route('/bye', array(
    '_controller' => 'render_template'
)));

function is_leap_year($year = null) {
    if (null === $year) {
        $year = date('Y');
    }

    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
}

$routes->add('year', new Route('/is_leap_year/{year}', array(
    'year' => null,
    '_controller' => function ($request) {
        if (is_leap_year($request->attributes->get('year'))) {
            //        添加属性  可用于模板中
            $request->attributes->set('desc', 'Yep, this is a leap year!');
        }else {
            $request->attributes->set('desc', 'Nope, this is not a leap year.');
        }

        $response = render_template($request);

        //        修改头信息
        $response->headers->set('Content-Type', 'text/html');
        return $response;
    }
)));


return $routes;