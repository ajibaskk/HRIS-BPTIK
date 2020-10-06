<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('countWeekday')) {
    function countWeekday($start, $end)
    {

        $current = $start;
        $count = 0;

        while (strtotime($current) <= strtotime($end)) {
            if (date('l', strtotime($current)) == 'Saturday' || date('l', strtotime($current)) == 'Sunday') {
                $count++;
            }

            $current = date('Y-m-d', strtotime($current . ' +1 day'));
        };

        return $count;
    }
}

if (!function_exists('dateRange')) {
    function dateRange($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
    {

        $dates = array();
        $current = strtotime($first);
        $last = strtotime($last);

        while ($current <= $last) {

            $dates[] = date($output_format, $current);
            $current = strtotime($step, $current);
        }

        return $dates;
    }
}

if (!function_exists('daysBetween')) {
    function daysBetween($date1, $date2)
    {
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);

        return $date1->diff($date2)->format('%a') + 1;
    }
}

if (!function_exists('dateLastDayOfMonth')) {
    function dateLastDayOfMonth($date)
    {
        return date("Y-m-t", strtotime($date));
    }
}
