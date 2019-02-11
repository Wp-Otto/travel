<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/2/11
 * Time: 17:45
 */

namespace Calendar\Model;


class LeapYear
{
    public function isLeapYear($year = null)
    {
        if (null === $year) {
            $year = date('Y');
        }

        return 0 == $year % 400 || (0 == $year % 4 && 0 != $year % 100);
    }
}