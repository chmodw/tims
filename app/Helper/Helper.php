<?php
/**
 * Created by PhpStorm.
 * User: chamodya wimansha
 * Date: 26/03/2019
 * Time: 12:18
 */

namespace App\Helper;


class Helper
{
    /**
     * Generate unique id from the given data
     * @param array $params
     * @return string
     */
    public static function uId(Array $params){
        array_push($params, date("M,d,Y h:i:s A"), rand(1,9999999));
        $str = implode($params);
        $str = str_replace(",","",$str);
        $str = str_replace(":","",$str);
        $str = str_replace(" ","",$str);

        return md5($str);
    }

    /**
     * @param $date
     * @param $time
     * @return false|string
     */
    public static function jointDateTime($date, $time){
        $timestamp = strtotime($date." ".$time);

        return date("Y-m-d H:i:s", $timestamp);
    }

}