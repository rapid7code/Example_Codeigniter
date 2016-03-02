<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mycommon
{
    function __get_random_instant_win($percent)
    {
        $random_percent = intval($percent) / 100;

        $weights = array();
        $weights[1] = $random_percent;
        $weights[0] = 1 - $random_percent;

        $rand = (float)mt_rand() / (float)mt_getrandmax();

        foreach ($weights as $value => $weight) {
            if ($rand < $weight) {
                $random_result = $value;
                break;
            }
            $rand -= $weight;
        }
        return $random_result;
    }

    function __dum($obj){
        print '<pre>';
        print_r($obj);
        print '</pre>';
    }
}