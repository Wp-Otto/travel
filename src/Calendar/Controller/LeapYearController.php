<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/2/11
 * Time: 17:16
 */
namespace Calendar\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Calendar\Model\LeapYear;

class LeapYearController
{
    public function indexAction(Request $request, $year)
    {
        $leapyear = new LeapYear();
        if ($leapyear->isLeapYear($year)) {
            $response = 'Yep, this is a leap year!'.mt_rand(1000,9999);
        }else {

            $response = 'Nope, this is not a leap year.'.mt_rand(1000,9999);
        }

//        $response->setTtl(10);

        return $response;
    }
}