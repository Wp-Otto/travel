<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/2/11
 * Time: 17:16
 */
namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
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
}